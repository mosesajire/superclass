<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolment extends Model
{
    protected $fillable = ['user_id', 'lesson_id', 'completed', 'status'];

    public function user() 
    {
    	return $this->belongsTo('App\User');
    }

    public function lesson()
    {
    	return $this->belongsTo('App\Lesson');
    }
}
