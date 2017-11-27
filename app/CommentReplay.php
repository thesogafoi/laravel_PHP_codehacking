<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReplay extends Model
{
    //
	protected $fillable = [
		'post_id' ,
		'is_active' ,
		'author' ,
		'email' ,
		'body' ,
		'comment_id'
	];
	
}
