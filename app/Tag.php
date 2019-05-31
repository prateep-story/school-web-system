<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
