<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'researches';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function personnel()
    {
        return $this->belongsTo('App\Personnel');
    }
}
