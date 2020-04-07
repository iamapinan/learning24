<?php

namespace App\Http\Controllers;

use Auth;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    protected $fieldUpload = ['id', 'title', 'description', 'agreement', 'cover_file', 'author', 'user_id', 'isPublic', 'fileUrl', 'group_id', 'cat_id', 'view', 'sub_cat', 'grade','link_test'];
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
    public function upload(Request $request)
    {
        $lastBookID = $this->getNextBookInsertID();
        $file = $request->file('bookfile')->store($lastBookID, 'book');
        $fullpath = Storage::disk('book')->path('/');
        $extract_dir = $fullpath . $lastBookID;
        chmod($fullpath . $lastBookID, 0777);
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

        $mainfile = $lastBookID . '/index.html';
        $coverfile = $lastBookID . '/files/large/1.jpg';
        $link_test = $request->attachment;

        $bookdata = array_combine($this->fieldUpload, [
            $lastBookID, 
            $request->filename, 
            $request->description, 
            1, 
            $coverfile, 
            $request->author, 
            $userid, 
            $request->isPublic, 
            $mainfile, $group, 
            $request->category, 
            0, 
            $request->sub, 
            $request->grade, 
            $link_test]);
        $groupdata = array_combine($this->fieldGroup, [$group, $lastBookID]);
        // print_r($bookdata);
        // exit;
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

        return DB::table('book')->insertGetId($data);
    }

    public function insertBookGroup($data)
    {

        return DB::table('book_group')->insert($data);
    }

    public function getLastBookID()
    {
        $last = DB::select('SELECT MAX(id) as last FROM book');
        return $last[0]->last;
    }

    public function getNextBookInsertID()
    {
        return $this->getLastBookID() + 1;
    }
}
