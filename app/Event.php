<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $dates = [
    'start_date',
    'end_date',
  ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
