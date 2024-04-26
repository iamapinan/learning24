<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    //
    protected $table = 'subcat';
    protected $primaryKey = 'id';
    protected $fillable = ['title'];
    public $timestamps = false;

    public function cat()
    {
        return $this->belongsTo('App\Cat');
    }
}
