<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guidance extends Model
{
    protected $table = 'guidances';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
