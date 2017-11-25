<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'photo_id',
		'title',
		'body' ,
		'user_id',
		'category_id'
	];
    protected $table = 'posts';
    
    public function user(){
    	return $this->belongsTo('App\User');
	}
	public function photo(){
		return $this->belongsTo('App\Photo');
	}
}
