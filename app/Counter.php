<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counters';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
