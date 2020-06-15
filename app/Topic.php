<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'body'];

    public function lesson()
    {
    	return $this->belongsTo('App\Lesson');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
