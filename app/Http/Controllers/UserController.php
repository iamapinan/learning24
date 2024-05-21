<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->s !== '')
            $data = DB::table('users')->where('name', 'like', '%' . $request->s . '%')->select()->orderBy('id', 'DESC')->paginate(20);
        else
            $data = DB::table('users')->select()->orderBy('id', 'DESC')->paginate(20);
        $org = DB::table('organization')->get();
        return view('UserManager')->with(['users' => $data, 'org' => $org]);
    }

    public function profile() {
        $data = DB::table('users')->where('id', Auth::user()->id )->select()->get();
        return view('profile')->with('profile', $data[0]);
    }

    public function create() {
        $user = Auth::user();
        if($user->role_id != 1)
            return redirect('/');
        $organization = DB::table('organization')->get();

        return view('create_user')->with(['org' => $organization]);
    }

    public function createUsers(Request $request) {
        // loop to create user to database.
        $number_of_user = $request->input('number');
        $prefix = $request->input('prefix');
        $role = $request->input('role');
        $current_date_time = now();
        $org = DB::table('organization')->where('id', $request->input('organization'))->first();

        for($i = 0; $i < $number_of_user; $i++) {
            $password = str_random(8);
            $random_name = random_int(100000, 999999);
            $data = array(
                'name' => $prefix . ' ' . $random_name,
                'email' => $prefix . '_' . $random_name . '@learning24.xyz',
                'init_password' => $password, // for reset password purpose
                'password' => bcrypt($password),
                'organization' => $org->title,
                'user_org_id' => $org->id,
                'role_id' => $role,
                'birthday' => '0000-00-00', 
                'email_verified_at' => '0000-00-00 00:00:00', 
                'email_verified' => 1, 
                'email_verification_token' => '',
                'remember_token' => '',
                'created_at' => $current_date_time,
                'updated_at' => $current_date_time
            );
            DB::table('users')->insert($data);
        }

        return response()->json(['status' => 'success']);
    }

    public function delete($id) {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['status' => 'success']);
    }


    public function update(Request $request) {
        $action = $request->input('action');
        $id = $request->input('id');
        
        if( $action == 'ban' ) {
            $status = $request->input('status');
            
            DB::table('users')->where('id', $id )
              ->update([
                  'email_verified' => $status
                ]);
            return response()->json(['status' => 'success']);
        }

        if( $action == 'org' ) {
            $org_data = DB::table('organization')->where('id', $request->input('org_value'))->first();
            DB::table('users')->where('id', $id )
              ->update([
                  'organization' => $org_data->title,
                  'user_org_id' => $request->input('org_value')
                ]);
            return response()->json(['status' => 'success']);
        }

        if( $action = 'reset') {
            $password = str_random(8);
            DB::table('users')->where('id', $id )
              ->update([
                  'init_password' => $password,
                  'password' => bcrypt($password)
                ]);
            return response()->json(['status' => 'success']);
        }
    }
    
}
