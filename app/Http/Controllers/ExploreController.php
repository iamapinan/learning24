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

        $title = isset($_GET['search']) ? 'ผลการค้นหา ' . $_GET['search'] : null;
        $sort = isset($_GET['sort']) && $_GET['sort'] == 'alphabet' ? 'title' : 'id';
        
        $contents_query = BookModel::Query()->where('isPublic', 1)
        ->when(isset($_GET['subject']) && $_GET['subject'] != 0, function ($query) {
            return $query->where('sub_cat', $_GET['subject']);
        })
        ->when(isset($_GET['level']), function ($query) {
            return $query->where('grade', $_GET['level']);
        })
        ->when(isset($_GET['search']), function ($query) {
            return $query->where('title', 'like', '%'.$_GET['search'].'%');
        })
        ->orderBy($sort, 'DESC')
        ->paginate(20);
    

        return view('explore', [
            'title' => $title,
            'levels'=> $levels,
            'subjects'=> $subjects,
            'sort'=> $sort,
            'contents' => $contents_query
        ]);
    }
}
