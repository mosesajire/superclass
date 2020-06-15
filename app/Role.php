<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	  // Table name
    protected $table = 'roles';

    // Primary key
    public $primaryKey = 'id';


    protected $fillable = ['name', 'description'];

    public function user() {
    	return $this->hasMany('App\User');
    }
}
