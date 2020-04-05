<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    //
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
        'gradetitle'
    ];

    public function index(Request $request) {

        $content = DB::table('all_book_data')
        ->select($this->fields)
        ->where('id', $request->id)->get();
        $title =  $content[0]->title.' - '. config('app.name');
        return view('view', ['content' => $content], compact('title'));
    }
}
