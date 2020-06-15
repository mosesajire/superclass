<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    public function lesson()
    {
    	return $this->hasMany('App\Lesson');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
