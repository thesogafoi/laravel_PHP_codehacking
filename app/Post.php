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
	public function imagePostPath(){
		return $this->user->path.$this->user->email.'/'.$this->photo->file;
	}
	public function category(){
		return $this->belongsTo('App\Cat' , 'category_id' , 'id');
	}
	
}
