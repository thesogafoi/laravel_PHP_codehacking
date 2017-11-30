<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$posts = Post::all();
        return view('admin.posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$cats = Cat::all()->pluck('name' , 'id');
		return view('admin.posts.create' , compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
    	$user = Auth::user();
    	$input = $request->all();
       if ($file = $request->file('photo_id')){
       		$file_name = 'post-'.$file->getClientOriginalName();
       		$file->move(public_path().'/images/'.$user->email , $file_name);
       		$photo = Photo::create(['file'=>$file_name]);
       		$input['photo_id'] = $photo->id;
	   }
	   $user->posts()->create($input);
       return redirect('/admin/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$post = Post::findOrFail($id);
    	$categories = Cat::all()->pluck('name' , 'id');
        return view('admin.posts.edit' , compact('post' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
		$input = $request->all();
		$post  = Post::findOrFail($id);
		if ($file = $request->file('photo_id')){
			$name = 'post-'.$file->getClientOriginalName();
			$photo = Photo::create(['file'=>$name]);
			if ($post->photo){
				Photo::findOrFail($post->photo->id)->delete();
				unlink(public_path().'/images/'.$post->user->email.'/'.$post->photo->file);
			}
			$input['photo_id'] = $photo->id;
			$file->move('images/'.$post->user->email, $name);
		}
		$post->update($input);
		return redirect('admin/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$post = Post::findOrFail($id);
		$post->delete();
		if ($post->photo){
			$post->photo->delete();
			unlink(public_path().'/images/'.$post->user->email.'/post-'.$post->photo->file);
		}
    	return redirect('admin/post');
    	
    }
    public function post($id){
    		$post = Post::findOrFail($id);
    		return view('post' , compact("post"));
	}
}
