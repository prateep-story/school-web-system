<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function awards()
    {
        return $this->hasMany('App\Award');
    }
}
