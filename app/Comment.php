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
		'body'
		
	];
	  public function replies(){
	  		return $this->hasMany('App\CommentReplay');
	  }
	  public function post(){
	  	return $this->belongsTo('App\Post');
	  }
	
	/**
	 * @return mixed
	 */
	public function user(){
	  		return $this->belongsTo('App\User' , 'email' , 'email');
	  }
	
	
	
	
	
}
