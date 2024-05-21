<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ChrisKonnertz\OpenGraph\OpenGraph;
use App\BookModel;

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
        'topic_id',
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
        // get subject and level
        $levels = DB::table('grade')->get();
        $subjects = DB::table('subcat')->get();
        $title = 'เนื้อหาทั้งหมด';

        // set title
        if(isset($_GET['level']) && $_GET['level'] != '' && $_GET['level'] != null)
        {
            $current_level = $levels->toArray();
            $current_level = array_values(array_filter($current_level, function($level) {
                return $level->grade_id == $_GET['level'];
            }))[0]->title;

            $title = $current_level . ' / ';
        } 

        if(isset($_GET['subject']) && $_GET['subject'] != 0 && $_GET['subject'] != null)
        {
            $current_subject = $subjects->toArray()[$_GET['subject']-1]->title;
            $title .= $current_subject;
        } 

        $title = isset($_GET['search']) && $_GET['search'] != null ? 'ผลการค้นหา '.$_GET['search'] : $title;
        $sort = isset($_GET['sort']) && $_GET['sort'] == 'alphabet' ? 'title' : 'id';
        
        $contents_query = BookModel::Query()->where('isPublic', 1)
        ->where('org_id', 1)
        ->when(isset($_GET['subject']) && $_GET['subject'] != 0 && $_GET['subject'] != null, function ($query) {
            return $query->where('sub_cat', $_GET['subject']);
        })
        ->when(isset($_GET['level']) && $_GET['level'] != '', function ($query) {
            return $query->where('grade', $_GET['level']);
        })
        ->when(isset($_GET['search']) && $_GET['search'] != null, function ($query) {
            return $query->where('title', 'like', '%'.$_GET['search'].'%');
        })
        ->orderBy($sort, 'DESC')
        ->paginate(20);

        return view('explore')->with([
            'title' => $title,
            'levels'=> $levels,
            'subjects'=> $subjects,
            'sort'=> $sort,
            'contents' => $contents_query
        ]);
    }

    public function org($id){
        // check user is login
        if (!Auth::check() && Auth::user()->user_org_id == null&&Auth::user()->user_org_id!=$id) {
            return redirect('/login?redirectTo=/org/'. $id);
        }
        
        $organization = DB::table('organization')->where('id', Auth::user()->user_org_id)->first();
        
        // get subject and level
        $levels = DB::table('grade')->get();
        $subjects = DB::table('subcat')->get();
        $title = 'เนื้อหาทั้งหมด';

        // set title
        if(isset($_GET['level']) && $_GET['level'] != '' && $_GET['level'] != null)
        {
            $current_level = $levels->toArray();
            $current_level = array_values(array_filter($current_level, function($level) {
                return $level->grade_id == $_GET['level'];
            }))[0]->title;
            $title = $current_level . ' / ';
        } 

        if(isset($_GET['subject']) && $_GET['subject'] != 0 && $_GET['subject'] != null)
        {
            $current_subject = $subjects->toArray()[$_GET['subject']-1]->title;
            $title .= $current_subject;
        } 

        $title = isset($_GET['search']) && $_GET['search'] != null ? 'ผลการค้นหา '.$_GET['search'] : $title;
        $sort = isset($_GET['sort']) && $_GET['sort'] == 'alphabet' ? 'title' : 'id';
        
        $contents_query = BookModel::Query()->where('isPublic', 1)
        ->where('org_id', $id)
        ->when(isset($_GET['subject']) && $_GET['subject'] != 0 && $_GET['subject'] != null, function ($query) {
            return $query->where('sub_cat', $_GET['subject']);
        })
        ->when(isset($_GET['level']) && $_GET['level'] != '', function ($query) {
            return $query->where('grade', $_GET['level']);
        })
        ->when(isset($_GET['search']) && $_GET['search'] != null, function ($query) {
            return $query->where('title', 'like', '%'.$_GET['search'].'%');
        })
        ->orderBy($sort, 'DESC')
        ->paginate(20);

        return view('org')->with([
            'title' => $title,
            'levels'=> $levels,
            'subjects'=> $subjects,
            'org' => $organization,
            'sort'=> $sort,
            'contents' => $contents_query
        ]);
    }
}

