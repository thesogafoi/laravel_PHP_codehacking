<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
	
	public $fillable = ['file'];
	
	public function users(){
		return $this->hasMany('App\User');
	}
	public function posts(){
		return $this->hasMany('App\Post');
	}
}
