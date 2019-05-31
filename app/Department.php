<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function personnels()
    {
        return $this->hasMany('App\Personnel');
    }
}
