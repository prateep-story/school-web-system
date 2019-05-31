<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function personnels()
    {
        return $this->hasMany('App\Personnel');
    }
}
