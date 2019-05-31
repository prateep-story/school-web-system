<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function highlights()
    {
        return $this->belongsToMany('App\Highlight');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
