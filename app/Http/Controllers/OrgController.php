<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrgController extends Controller
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
            $data = DB::table('organization')->where('title', 'like', '%' . $request->s . '%')->select()->orderBy('id', 'DESC')->paginate(20);
        else
            $data = DB::table('organization')->select()->orderBy('id', 'DESC')->paginate(20);
        
        return view('OrgManager')->with(['org' => $data]);
    }

    public function create() {
        
        $organization = DB::table('organization')->get();

        return view('create_org')->with(['org' => $organization]);
    }

    public function store(Request $request) {
        
        $data = array(
            'title' => $request->input('title'),
            'user_limit' => $request->input('number'),
            'status' => 1,
        );
        DB::table('organization')->insert($data);
        return response()->json(['status' => 'success']);
    }

    public function delete($id) {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['status' => 'success']);
    }


    public function update(Request $request) {
        $title = $request->input('org_value');
        $id = $request->input('id');
        
        DB::table('organization')->where('id', $id )
            ->update([
                'title' => $title
            ]);
        return response()->json(['status' => 'success']);
    }
    
}
