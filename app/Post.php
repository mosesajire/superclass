<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	  // Table name
    protected $table = 'posts';

    // Primary key
    public $primaryKey = 'id';


    protected $fillable = ['title', 'body', 'cover_image'];


    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function category() {
    	return $this->belongsTo('App\Category');
    }
}
