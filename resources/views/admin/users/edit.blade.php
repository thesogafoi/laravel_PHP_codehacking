@extends('layouts.admin')

@section('content')

    <h1>Edit Users </h1>
    <div class="col-sm-3">
        <img class="img-responsive" src="{{$user->photo_id ? $user->imagePath(): 'https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/2383454/580/386/m1/fpnw/wm0/creative-24-.png?1489056658&s=c0c68cb152372f5b66acee0ce60178ee'}}" alt="">
    @if(count($errors) > 0)
        <div style="color: darkred;">
            <h5 class="center-block text-center">we have some error</h5>
        </div>
    @endif
    </div>
    <div class="col-sm-9">


    {!! Form::model($user , ['action'=>['AdminUsersController@update' , $user->id],'method'=>'PATCH' ]) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name : ', ['class' => 'awesome']) !!}
        {!! Form::text('name',null ,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email : ', ['class' => 'awesome']) !!}
        {!! Form::email('email',null ,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role : ', ['class' => 'awesome']) !!}
        {!!  Form::select('role_id',$roles ,$user->role,['class'=>'form-control'])

         !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Status : ', ['class' => 'awesome']) !!}
        {!!  Form::select('is_active', [1 => 'Active', 0 => 'not Active'], null,
        ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Upload Your Image', ['class' => 'awesome']) !!}
        {!! Form::file('file' , ['class'=>'']) !!}
    </div>
    <div class="form-group">
        <a class="text-center" href="{{route('admin.users.index')}}"><p class="alert alert-info">Change Password</p></a>
    </div>
        <div class="form-group">
        {!! Form::submit('Create' , ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    @include('include.form_error')

    </div>
@endsection