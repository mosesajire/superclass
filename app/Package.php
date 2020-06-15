<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description'];


    public function user()
    {
    	return $this->belongsTo('App\User');
    }


    public function lesson()
    {
    	return $this->hasMany('App\Lesson');
    }
}
