<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
