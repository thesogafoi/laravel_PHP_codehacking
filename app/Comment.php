<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	
	protected $fillable = [
		'post_id' ,
		'is_active' ,
		'author' ,
		'email' ,
		'body' ,
		'post_id'
		
	];
	  public function replies(){
	  		return $this->hasMany('App\commentReplay');
	  }
	
	
	
	
	
}
