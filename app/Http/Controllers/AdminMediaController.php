<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Photo;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

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
    	Photo::create($request->all());
	}
	public function destroy($id ){
		$photo = Photo::findOrFail($id);
		$user  = Auth::user();
		$path = public_path().'/images/'.$user->email . '/'.$photo->file;
		if ($user->photo_id = $id){
			$user->photo_id = 0;
			$user->save();
		}
		print_r($path.'<br>');
		if (file_exists($path)){
			unlink($path);
		}
		$photo->delete();
		return redirect('/admin/media');
	}
}
