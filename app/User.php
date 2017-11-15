<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $path = '/images/';
    protected $fillable = [
        'name', 'email', 'password','role_id','photo_id','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function role(){
    	return $this->belongsTo('App\Role' , 'role_id' , 'id');
	}
	public function photo(){
    	return $this->belongsTo('App\Photo');
	}
	public function imagePath(){
		return $this->path. $this->email .'/'.$this->photo->file;
	}
}
