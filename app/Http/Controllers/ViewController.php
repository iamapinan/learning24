<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ChrisKonnertz\OpenGraph\OpenGraph;

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
        'org_id', 
        'cat_id',
        'topic_id',
        'view', 
        'sub_cat', 
        'grade', 
        'subject', 
        'type_book',
        'gradetitle',
        'link_pretest',
        'link_test'
    ];

    public function index(Request $request) {

        if (!Auth::check()) {
            return redirect('/login?redirectTo=/explore');
        }

        $content = DB::table('book')
        ->select(DB::raw('book.id, book.title, book.description, book.cover_file, book.author, book.user_id, book.isPublic, book.fileUrl, book.org_id, book.cat_id, book.topic_id, book.view, book.sub_cat, book.grade, subcat.title as subject, grade.title as gradetitle, book.link_test,book.link_pretest, book.recommend, topics.title as topictitle, book.video_url, book.type_book'))
        ->leftJoin('topics', 'book.topic_id', '=', 'topics.id')
        ->leftJoin('grade', 'book.grade', '=', 'grade.grade_id')
        ->leftJoin('subcat', 'book.sub_cat', '=', 'subcat.id')
        ->where('book.id', $request->id)
        ->first();

        if($content == null) {
            return redirect('/404');
        }

        $title =  $content->title.' - '. config('app.name');

        DB::table('book')
        ->where('id', $request->id)
        ->update(['view'=>($content->view+1)]);

        if(!Auth::guest()) {
            DB::table('view_history')
            ->insert(['content_id'=>$request->id, 'user'=>Auth::user()->id]);
        }

        return view('view', ['content' => $content], compact('title'));
    }
}
