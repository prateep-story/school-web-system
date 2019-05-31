<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $table = 'personnels';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    public function researchs()
    {
        return $this->hasMany('App\Research');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
