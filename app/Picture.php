<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'pictures';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
