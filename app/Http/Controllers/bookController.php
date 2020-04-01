<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bookController extends Controller
{
    protected $bookkey = ['id', 'title', 'description', 'cover_file', 'author', 'user_id', 'isPublic', 'fileUrl', 'group_id', 'cat_id', 'view', 'sub_cat', 'grade', 'subject', 'gradetitle'];

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $BOOK = DB::table('all_book_data')->select($this->bookkey)->where('cat_id', '<>', '10')->where('type_book', '<>', '1')->orderBy('id', 'DESC')->paginate(20);
       
        return view('book')->with('books', $BOOK);
    }
}
