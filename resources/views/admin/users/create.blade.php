@extends('layouts.admin')

@section('content')
    <h1>Create Users </h1>
    @if(count($errors) > 0)
        <div style="color: darkred;">
            <h5 class="center-block text-center">we have some error</h5>
        </div>
        @endif
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
                    {!! Form::label('role_id', 'Role : ', ['class' => 'awesome']) !!}
                    {!!  Form::select('role_id',$roles , ['class'=>'form-control'], ['placeholder' => 'choose Option' ,
                    'class' => 'form-control'])
                     !!}
                </div>
                <div class="form-group">
                    {!! Form::label('is_active', 'Status : ', ['class' => 'awesome']) !!}
                    {!!  Form::select('is_active', [1 => 'Active', 0 => 'not Active'], 0 , ['class'=>'form-control']) !!}
                </div>
                    <div class="form-group">
                        {!! Form::label('file', 'Upload Your Image', ['class' => 'awesome']) !!}
                        {!! Form::file('file' , ['class'=>'']) !!}
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