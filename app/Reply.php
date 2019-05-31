<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function reply()
    {
        return $this->belongsTo('App\Reply');
    }
}
