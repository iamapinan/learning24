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
        $select_fields = [
            'organization.id as id', 
            'organization.title as title', 
            'organization.user_limit as user_limit',
            'organization.status as status',
            'org_type.type_name as type_name',
            'org_type.type_name_eng as type_name_eng'
        ];
        if($request->s !== '')
            $data = DB::table('organization')
            ->where('organization.title', 'like', '%' . $request->s . '%')
            ->select($select_fields)
            ->leftJoin('org_type', 'organization.type_id', '=', 'org_type.id')
            ->orderBy('organization.id', 'DESC')
            ->paginate(20);
        else
        $data = DB::table('organization')
            ->select($select_fields)
            ->leftJoin('org_type', 'organization.type_id', '=', 'org_type.id')
            ->orderBy('organization.id', 'DESC')
            ->paginate(20);


        return view('OrgManager')->with(['org' => $data]);
    }

    public function create() {
        
        $organization = DB::table('organization')->get();
        $org_type = DB::table("org_type")->get();
        return view('create_org')->with(['org' => $organization, 'type' => $org_type]);
    }

    public function store(Request $request) {
        
        $data = array(
            'title' => $request->input('title'),
            'user_limit' => $request->input('number'),
            'status' => 1,
            'type_id' => $request->input('org_type')
        );
        DB::table('organization')->insert($data);
        return response()->json(['status' => 'success']);
    }

    public function delete($id) {
        DB::table('users')->where('id', $id)->delete();
        DB::table('organization')->where('id', $id)->delete();
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
