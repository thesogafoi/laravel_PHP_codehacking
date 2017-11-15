<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
	
	public $fillable = ['file'];
	
	public function users(){
		return $this->hasMany('App\users');
	}
	
}
