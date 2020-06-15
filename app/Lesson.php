<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'body'];

    public function package() 
    {
        return $this->belongsTo('App\Package');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Subject');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function topic()
    {
    	return $this->hasMany('App\Topic');
    }

    public function enrolment()
    {
        return $this->hasMany('App\Enrolment');
    }
}
