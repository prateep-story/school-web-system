<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
