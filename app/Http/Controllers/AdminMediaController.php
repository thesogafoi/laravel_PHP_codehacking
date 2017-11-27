<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    public function index(){
    	$photos = Photo::all();
    	$user  = Auth::user();
    	return view('admin.media.index' , compact('photos' , 'user'));
	}
	public function uploadPage() {
    	return view('admin.media.uploadpage');
	}
	public function upload(PhotoRequest $request){
    	
    	$file = $request->file('file');
    	$name = $file->getClientOriginalName();
    	$user = Auth::user();
    	if (!file_exists(public_path().'/images/'.$user->email .'/'. $name)){
			$file->move(public_path().'/images/'.$user->email , $name);
			Photo::create(['file'=>$name]);
		}
	}
	public function destroy($id ){
		$photo = Photo::findOrFail($id);
		$user  = Auth::user();
		$posts = Post::all();
		$path = public_path().'/images/'.$user->email . '/'.$photo->file;
		if ($user->photo_id = $id){
			$user->photo_id = 0;
			$user->save();
		}
		foreach($posts as $post){
			if($post->photo_id = $id){
				$post->photo_id = 0;
				$post->save();
			}
		}
		print_r($path.'<br>');
		if (file_exists($path)){
			unlink($path);
		}
		$photo->delete();
		Session::flash('image_deleted',"The Image Has Been Deleted");
		return redirect('/admin/media');
	}
}
