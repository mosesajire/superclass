<?php

namespace App;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'group_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
      // Table name
    protected $table = 'users';

    // Primary key
    public $primaryKey = 'id';


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function category() {
       return $this->hasMany('App\Category');
    }

    public function post() {
       return $this->hasMany('App\Post');
    }

    public function image() {
        return $this->hasMany('App\Image');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function package() {
        return $this->hasMany('App\Package');
    }

    public function course() {
        return $this->hasMany('App\Subject');
    }

    public function lesson() {
        return $this->hasMany('App\Lesson');
    }

    public function topic() {
        return $this->hasMany('App\Topic');
    }

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function enrolment() {
        return $this->hasMany('App\Enrolment');
    }
}

