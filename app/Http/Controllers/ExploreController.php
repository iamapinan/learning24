<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ChrisKonnertz\OpenGraph\OpenGraph;

class ExploreController extends Controller
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
        'link_test',
        'recommend'
    ];
    //
    public function index(Request $request){
        // check user is login
        if (!Auth::check()) {
            return redirect('/login?redirectTo=/explore');
        }
        // get user data
        $user = Auth::user();

        $filter = $_GET['subject'] ?? $_GET['level'] ?? $_GET['search'] ?? null;
        $filter_type = null;
        $current_subject = 'เนื้อหาทั้งหมด';
        $current_level = 'เนื้อหาทุกระดับชั้น';
        $subjects = DB::table('subcat')->get();
        $levels = DB::table('grade')->get();

        if(isset($_GET['subject']) && $_GET['subject'] != 0) {
            $filter_type = 'sub_cat';
            $current_subject = array_values($subjects->toArray())[$_GET['subject']-1]->title;
        } else if(isset($_GET['level'])) {
            $filter_type = 'grade';
            $current_level = array_values($levels->toArray())[$_GET['level']-1]->title;
        } else {
            $filter_type = 'title';
            $filter = '%'.$filter.'%';
        }
        $title = isset($_GET['search']) ? 'ผลการค้นหา ' . $_GET['search'] : $current_subject;
        $sort = isset($_GET['sort']) && $_GET['sort'] == 'alphabet' ? 'title' : 'id';
        
        $contents = DB::table('all_book_data')
        ->select($this->fields)
        ->where('isPublic', 1)
        ->where($filter_type, $filter)
        ->orderBy($sort, 'DESC')
        ->paginate(20);
        
        return view('explore', [
            'title' => $title,
            'levels'=> $levels,
            'subjects'=> $subjects,
            'filters'=> [
                'subject'=> $current_subject,
                'level'=> $current_level,
                'search'=> $filter
            ],
            'sort'=> $sort,
            'user'=> $user,
            'contents'=>$contents
        ]);
    }
}
