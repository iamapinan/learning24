<?php

namespace App\Http\Controllers;

use Auth;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Imagick;
class UploadController extends Controller
{

    protected $fieldUpload = ['id', 'title', 'description', 'agreement', 'cover_file', 'author', 'user_id', 'isPublic', 'fileUrl', 'group_id', 'cat_id', 'topic_id', 'view', 'sub_cat', 'grade','link_pretest', 'link_test', 'type_book', 'video_url'];
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
        $sub = $this->getSubcat();
        $grade = $this->getGrade();
        return view('upload')
        ->with('sub', $sub)
        ->with('grade', $grade);
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

    public function getTopics(Request $request)
    {
        $topics = DB::table('topics')->select('id', 'title')
        ->where('subcat_id', $request->subject)
        ->where('grade_id', $request->level)
        ->get();
        return response()->json(['status' => 'success', 'data' =>$topics]);
    }
    // Upload handle.
    // @return Respose
    public function upload(Request $request)
    {
        $lastBookID = $this->getNextBookInsertID();
  
        if($request->type_book == 0) { // E-Book
        //     //Upload file
            $file = $request->file('bookfile')->store($lastBookID, 'book');
            $fullpath = Storage::disk('book')->path('/');
            // print_r($fullpath);
            chmod($fullpath . $lastBookID, 0777);
        //     //Extract files
            $extract_dir = $fullpath . $lastBookID;
            $zipper = new Zipper;
    
            $zipper->make($fullpath . $file)->folder('')->extractTo($extract_dir);
    
            $contents = scandir($extract_dir);
            // check if $contents is a directory and actually has items
            if (is_array($contents) && count($contents)) {
                foreach($contents as $item) { // loop through directory contents
                    if (substr(strtolower($item), -5) == ".html") { // checking if a file ends with .html
                    rename($extract_dir . "/" . $item, $extract_dir . "/index.html"); // rename it to index.html
                    break; // no need to loop more, job's done
                    }
                }
            }
    
            unlink($fullpath . $file);
            $zipper->close();

            $mainfile = $lastBookID . '/index.html';
            $coverfile = $lastBookID . '/files/large/1.jpg';

        } else { // PDF
            $md5Name = md5_file($request->file('pdf_bookfile')->getRealPath());
            $guessExtension = $request->file('pdf_bookfile')->guessExtension();

            $pdf_store_file = $request->file('pdf_bookfile')->storeAs($lastBookID, $md5Name.'.'.$guessExtension  ,'book');
            $pdf_path = Storage::disk('book')->path($pdf_store_file);

            $im = new Imagick($pdf_path.'[0]');
            $im->setImageFormat('jpg');
            $coverfile = $lastBookID.'/cover.jpg';
            $mainfile = $lastBookID . '/' . $md5Name.'.'.$guessExtension;
            file_put_contents(Storage::disk('book')->path($coverfile), $im);
        }

        if (!isset($request->isPublic)) {
            $request->isPublic = 0;
        }

        $userid = ($request->userid == '') ? Auth::user()->id : $request->userid;
        $group = Auth::user()->user_org_id == null ? 1 : Auth::user()->user_org_id;
        $topic = $request->topic;
        $sub = $request->sub;
        $grade = $request->grade;
        $link_test = $request->attachment;
        $bookdata = array_combine($this->fieldUpload, [
            $lastBookID, 
            $request->filename, 
            $request->description, 
            1, 
            $coverfile, 
            $request->author, 
            $userid, 
            $request->isGlobal,
            $mainfile, 
            $group, 
            0, 
            $topic,
            0, 
            $request->sub, 
            $request->grade, 
            $request->before_attachment,
            $link_test,
            $request->type_book,
            $request->video_url
        ]);
        // $groupdata = array_combine($this->fieldGroup, [$group, $lastBookID]);

        $createbook = $this->insertBook($bookdata);
        // $this->insertBookGroup($groupdata);

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
