<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    protected $table = 'highlights';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
