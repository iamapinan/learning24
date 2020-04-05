<?php

namespace App\Http\Controllers;

use Auth;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{

    protected $fieldUpload = ['id', 'title', 'description', 'cover_file', 'author', 'user_id', 'isPublic', 'fileUrl', 'group_id', 'cat_id', 'view', 'sub_cat', 'grade'];
    protected $fieldGroup = ['group_id', 'book_id'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getCat = $this->getCategoryList();
        $sub = $this->getSubcat();
        $grade = $this->getGrade();
        return view('upload')->with('category', $getCat)->with('sub', $sub)->with('grade', $grade);
    }

    public function getCategoryList()
    {
        return DB::table('categories')->select('cat_id', 'title', 'parent_id')->get();
    }

    public function getSubcat()
    {
        return DB::table('subcat')->select('id', 'title')->get();
    }

    public function getGrade()
    {
        return DB::table('grade')->select('grade_id as id', 'title')->get();
    }
    // Upload handle.
    // @return Respose
    public function bookCreate(Request $request)
    {

        $file = $request->file('bookfile')->store($this->getNextBookInsertID(), 'book');

        $fullpath = env('API_FILE_DIR') . '/book/';
        $extract_dir = $fullpath . $this->getNextBookInsertID();
        chmod($fullpath . $this->getNextBookInsertID(), 0777);
        //Extract files

        $zipper = new Zipper;

        $zipper->make($fullpath . $file)->folder('')->extractTo($extract_dir);

        unlink($fullpath . $file);
        $zipper->close();
        if (!isset($request->isPublic)) {
            $request->isPublic = 0;
        }

        $userid = ($request->userid == '') ? Auth::user()->id : $request->userid;
        $group = ($request->group == '') ? 0 : $request->group;

        $mainfile = $this->getNextBookInsertID() . '/index.html';
        $coverfile = $this->getNextBookInsertID() . '/files/thumb/1.jpg';
        $bookdata = array_combine($this->fieldUpload, [$this->getNextBookInsertID(), $request->filename, $request->description, $coverfile, $request->author, $userid, $request->isPublic, $mainfile, $group, $request->category, 0, $request->sub, $request->grade]);
        $groupdata = array_combine($this->fieldGroup, [$group, $this->getNextBookInsertID()]);

        $createbook = $this->insertBook($bookdata);
        $this->insertBookGroup($groupdata);

        if ($createbook != '') {
            return back()->with('status', 'บันทึกเรียบร้อยแล้ว');
        } else {
            return back()->withInput($request->input())->with('status', 'บันทึกไม่สำเร็จ');
        }

    }

    public function insertBook($data)
    {

        return DB::table(env('BOOK_TABLE'))->insertGetId($data);
    }

    public function insertBookGroup($data)
    {

        return DB::table(env('BOOKGROUP_TABLE'))->insert($data);
    }

    public function getLastBookID()
    {
        $last = DB::select('SELECT MAX(id) as last FROM ' . env('BOOK_TABLE'));
        return $last[0]->last;
    }

    public function getNextBookInsertID()
    {
        return $this->getLastBookID() + 1;
    }
}
