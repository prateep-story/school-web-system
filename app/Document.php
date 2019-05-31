<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function Files()
    {
        return $this->hasMany('App\File');
    }
}
