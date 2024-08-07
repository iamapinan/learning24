<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\SocialAccount;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Social Login
     */
    public function redirectToProvider($provider = 'facebook')
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider = 'facebook')
    {  
        $providerUser = \Socialite::driver($provider)->user();
        $user = $this->createOrGetUser($provider, $providerUser);

        auth()->login($user);
        return redirect()->to('/home');
    }

    public function createOrGetUser($provider, $providerUser)
    {
        /** Get Social Account */
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            /** Get user detail */
            $userDetail = Socialite::driver($provider)->userFromToken($providerUser->token);

            /** Create new account */
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider,
            ]);

            /** Get email or not */
            $email = !empty($providerUser->getEmail()) ? $providerUser->getEmail() : $providerUser->getId() . '@' . $provider . '.com';

            /** Get User Auth */
            if (auth()->check()) {
                $user = auth()->user();
            }else{
                $user = User::whereEmail($email)->first();
            }

            if (!$user) {
                /** Get Avatar */
                $image = $provider . "_" . $providerUser->getId() . ".png";
                $imagePath = Storage::disk('users')->path('avatar/')  . $image;
                file_put_contents($imagePath, file_get_contents($providerUser->getAvatar()));

                /** Create User */
                $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName(),
                    'username' => $providerUser->getId(),
                    'avatar' => $image,
                    'password' => bcrypt(rand(1000, 9999)),
                    'organization' => '',
                    'birthday' => '',
                    'email_verification_token' => '',
                    'email_verified' => 1,
                    'email_verified_at' => now()
                ]);

            }

            /** Attach User & Social Account */
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
    // Login
    public function login (Request $request) {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            
            if (auth()->user()->email_verified == 1) {
                // if has redirectTo page
                if (!empty($request->redirectTo)) {
                    return redirect($request->redirectTo);
                }
                // if user not admin redirect to explore page
                // else redirect to home page
                if (!auth()->user()->is_admin) {
                    return redirect('/explore');
                }
            } else {
                Auth::logout();
                return $this->sendFailedLoginResponse($request, "บัญชีถูกระงับการใช้งาน");
            }
            
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout (Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }
}
