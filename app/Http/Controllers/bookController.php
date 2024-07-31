<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class bookController extends Controller
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
        'org_id', 
        'cat_id',
        'topic_id',
        'view', 
        'sub_cat', 
        'grade', 
        'subject', 
        'gradetitle',
        'link_test'
    ];

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    //
    public function index(){
        $books = [];
        $books = DB::table('book')
        ->select(DB::raw('book.id, book.title, book.description, book.cover_file, book.author, book.user_id, book.isPublic, book.fileUrl, book.org_id, book.cat_id, subcat.title as subject, book.topic_id, book.view, book.sub_cat, book.grade,  grade.title as gradetitle, topics.title as topictitle'))
        ->leftJoin('grade', 'book.grade', '=', 'grade_id')
        ->leftJoin('subcat', 'book.sub_cat', '=', 'subcat.id')
        ->leftJoin('topics', 'book.topic_id', '=', 'topics.id')
        ->where('book.user_id', Auth::id())
        ->orderBy('book.id', 'DESC')
        ->paginate(20);
       
        return view('book')->with('books', $books);
    }

    public function search(Request $request){

        $books = DB::table('book')
        ->select($this->fields)
        ->where('user_id', Auth::id())
        ->where('title', 'like', '%' . $request->q . '%')
        ->orWhere('description', 'like', '%' . $request->q . '%')
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('book')->with('books', $books);
    }

    public function subjects() {
        $subjects = DB::table('subcat')->get();
        return view('subjects')->with('subjects', $subjects);
    }

    public function topics($id) {
        $topics = DB::table('topics')
        ->select(DB::raw('topics.id, topics.title, topics.grade_id, grade.title as gradetitle'))
        ->where('subcat_id', $id)
        ->leftJoin('grade', 'topics.grade_id', '=', 'grade.grade_id')
        ->orderBy('id', 'DESC')
        ->paginate(25);

        $subject = DB::table('subcat')
        ->where('id', $id)
        ->first();

        $levels = DB::table('grade')
        ->select(["grade_id as id", "title"])
        ->get();
        
        return view('subject')->with([
            'topics' => $topics, 
            'subject' => $subject,
            'levels' => $levels
        ]);
    }

    public function topic($id) {
        $contents = DB::table('all_book_data')
        ->where('topic_id', $id)
        ->orderBy('id', 'DESC')
        ->paginate(25);

        $topic = DB::table('topics')
        ->where('id', $id)
        ->first();
        
        return view('topic')->with([
            'contents' => $contents,
            'topic' => $topic
        ]);
    }

    public function search_topic(Request $request) {
        $topics = DB::table('topics')
        ->select(DB::raw('topics.id, topics.title, topics.grade_id, topics.subcat_id, grade.title as gradetitle'))
        ->where('topics.subcat_id', $request->subject_id)
        ->where('topics.title', 'like', '%' . $request->q . '%')
        ->leftJoin('grade', 'topics.grade_id', '=', 'grade.grade_id')
        ->paginate(25);

        return response()->json([
            'topics' => $topics,
            'role' => Auth::user()->role_id
        ]);
    }

    public function delete_topic($id) {
        DB::table('topics')->where('id', $id)->delete();
        return response()->json(['status' => 'success']);
    }

    public function create_topic($id) {
        $level = DB::table('grade')->get();
        $subject = DB::table('subcat')
        ->where('id', $id)
        ->first();

        return view('create_topic')->with([
            'levels' => $level,
            'subject' => $subject
        ]);
    }

    public function store_topic(Request $request) {
        DB::table('topics')->insert([
            'subcat_id' => $request->subject,
            'grade_id' => $request->grade,
            'title' => $request->title
        ]);
        return response()->json(['status' => 'success']);
    }

    public function edit_topic($id) {
        $topic = DB::table('topics')
        ->where('id', $id)
        ->first();
        $levels = DB::table('grade')->get();

        return view('edit_topic')->with([
            'topic' => $topic,
            'levels' => $levels
        ]);
    }

    public function update_topic(Request $request) {
        DB::table('topics')
        ->where('id', $request->id)
        ->update([
            'title' => $request->title,
            'grade_id' => $request->grade
        ]);
        return response()->json(['status' => 'success']);
    }

    public function recommend(Request $request) {
        DB::table('book')
        ->where('id', $request->id)
        ->update(['recommend' => 1]);
        return back()->with('status', 'ตั้งเป็นเนื้อหาแนะนำแล้ว');
    }

    public function un_recommend(Request $request) {
        DB::table('book')
        ->where('id', $request->id)
        ->update(['recommend' => 0]);
        return back()->with('status', 'ยกเลิกเนื้อหาแนะนำแล้ว');
    }

    public function delete(Request $request) {

        $directory = Storage::disk('book')->path('/') . $request->id;
        DB::table('book')->where('id', '=', $request->id)->delete();
        Storage::deleteDirectory($directory);
        return back()->with('status', 'ลบเสร็จแล้ว');
    }
}
