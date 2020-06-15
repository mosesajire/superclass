<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	  // Table name
    protected $table = 'categories';

    // Primary key
    public $primaryKey = 'id';

    protected $fillable = ['name', 'description'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->hasMany('App\Post');
    }
}
