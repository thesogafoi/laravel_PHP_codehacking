<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReplay extends Model
{
    //
	protected $table  = 'comment_replies';
	protected $fillable = [
		'is_active' ,
		'author' ,
		'email' ,
		'body' ,
		'comment_id'
	];
	
	public function comments(){
		return $this->belongsTo('App\Comment');
		
	}
	public function user(){
		return $this->belongsTo('App\User' , 'email' , 'email');
		
	}
	
	
}
