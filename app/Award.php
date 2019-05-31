<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio');
    }
}
