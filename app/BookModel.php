<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookModel extends Model
{
    //
    protected $table = 'book';
    protected $primaryKey = 'id';

    protected $fillable = [
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
        'recommend',
        'created_at',
        'updated_at',
        'video_url'
    ];
}
