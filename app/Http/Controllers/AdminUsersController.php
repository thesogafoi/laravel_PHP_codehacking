<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
Use App\Role;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        //
		$users = User::all();
		return view('admin.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roles = Role::pluck('name' , 'id');
		return view('admin.users.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
		$input   = $request->all();
		if ($file = $request->file('file')){
			 $name = $file->getClientOriginalName();
			 $photo = Photo::create(['file'=>$name]);
			 $input['photo_id'] = $photo->id;
			 $file->move('images/'.$request->email, $name);
		}
		$input['password'] = bcrypt($request->password);
		User::create($input);
		return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = User::findOrFail($id);
		$roles = Role::pluck('name' , 'id');
		return view('admin.users.edit' , compact('user' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $input = $request->all();
        $user  = User::findOrFail($id);
        if ($file = $request->file('file')){
			$name = $file->getClientOriginalName();
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
			$file->move('images/'.$request->email, $name);
		}
		if ($request->email != $user->email){
			rename('images/'.$user->email , 'images/'.$request->email);
		}
		$user->update($input);
		return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
