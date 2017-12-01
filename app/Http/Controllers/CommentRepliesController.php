<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReplay;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('admin.media.uploadpage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
	public function createReplay (CommentRequest $request)
	{
		//
		$user = Auth::user();
		$data  = [
			'comment_id' => $request->comment_id,
			'author'  => $user->name,
			'email'   => $user->email ,
			'body'    => $request->body
		];
		
		$replay = CommentReplay::create($data);
		Session::flash('replay_message' , 'Your Replay Has been Added');
		return redirect('post/'.$replay->comment->post->slug.'/'.'#hooked');
		
	}
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$comment = Comment::findOrFail($id);
        $replies = $comment->replies;
        return view('admin.comments.replies.show' , compact('replies' , 'comment'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CommentReplay::findOrFail($id)->update($request->all());
		Session::flash('replay_message' , 'Replay Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommentReplay::findOrFail($id)->delete();
        Session::flash('replay_message' , 'Replay Deleted');
        return redirect()->back();
    }
}
