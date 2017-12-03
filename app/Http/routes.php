<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/post/{id}' , ['as'=>'home.post' , 'uses'=>'AdminPostsController@post']);


Route::group(['middleware'=>'Admin'] , function(){
	Route::get('/admin', function(){
		return view('admin.index');
	});
	Route::resource('/admin/users' , 'AdminUsersController');
	Route::resource('/admin/post' , 'AdminPostsController');
	Route::resource('/admin/categories' , 'AdminCategoriesController');
	Route::get('/admin/media' , ['as'=>'admin.media.index' , 'uses'=>'AdminMediaController@index']);
	Route::get('/admin/media/upload' , ['as'=>'admin.media.uploadpage' , 'uses'=>'AdminMediaController@uploadPage']);
	Route::delete('/admin/media/{key}' ,'AdminMediaController@destroy');
	Route::post('/admin/media' ,'AdminMediaController@upload');
	Route::resource('/admin/comments' ,'AdminCommentsController');
	Route::resource('/admin/comments/replies' ,'CommentRepliesController');
});
	
	
	Route::group(['middleware'=>'auth'] , function(){
		Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
		Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
		Route::post('/comment/replay' ,'CommentRepliesController@createReplay');
	});


