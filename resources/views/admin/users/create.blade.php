@extends('layouts.admin')

@section('content')
    <h1>Create Users </h1>

     {!! Form::open(['action'=>'AdminUsersController@store' , 'method'=>'POST' , 'files'=>true]) !!}
               <div class="form-group">
                   {!! Form::label('name', 'Name : ', ['class' => 'awesome']) !!}
                   {!! Form::text('name',null ,['class'=>'form-control']) !!}
               </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email : ', ['class' => 'awesome']) !!}
                    {!! Form::email('email',null ,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('role', 'Role : ', ['class' => 'awesome']) !!}
                    {!!  Form::select('role',$roles , ['class'=>'form-control'], ['placeholder' => 'choose Option' ,
                    'class' => 'form-control'])
                     !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status : ', ['class' => 'awesome']) !!}
                    {!!  Form::select('status', [1 => 'Active', 0 => 'not Active'], 0 , ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password : ', ['class' => 'awesome']) !!}
                    {!! Form::password('password', ['class' => 'form-control'])!!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Create' , ['class' => 'btn btn-primary']) !!}
                </div>
    {!! Form::close() !!}

    @include('include.form_error')
@endsection