<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $dates = [
        'online_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, $this->name));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail($this->name));
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
    }


    public function categories()
    {
        return $this->hasMany('App\Category');
    }
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
    public function documents()
    {
        return $this->hasMany('App\Document');
    }
    public function files()
    {
        return $this->hasMany('App\File');
    }
    public function hightlights()
    {
        return $this->hasMany('App\Highlight');
    }
    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }
    public function events()
    {
        return $this->hasMany('App\Event');
    }
    public function departments()
    {
        return $this->hasMany('App\Department');
    }
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
    public function personnels()
    {
        return $this->hasMany('App\Personnel');
    }
    public function portfolios()
    {
        return $this->hasMany('App\Portfolio');
    }
    public function awards()
    {
        return $this->hasMany('App\Award');
    }
    public function researchs()
    {
        return $this->hasMany('App\Research');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
    public function informations()
    {
        return $this->hasMany('App\Information');
    }
}
