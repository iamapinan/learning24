<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShelfController extends Controller
{
    protected $fields = [
        'id', 
        'title', 
        'description', 
        'cover_file', 
        'author', 
        'user_id', 
        'isPublic', 
        'fileUrl', 
        'group_id', 
        'cat_id', 
        'view', 
        'sub_cat', 
        'grade', 
        'subject', 
        'gradetitle',
        'link_test'
    ];
    //
    public function index(Request $request){

        $books = DB::table('all_book_data')
        ->select($this->fields)
        ->where('user_id', $request->id)
        ->orderBy('id', 'DESC')
        ->paginate(20);

        $user = DB::table('users')->select(['id','name'])->where('id', $request->id)->get();

        return view('list', ['list'=> $books, 'user'=> $user[0]]);
    }
}
