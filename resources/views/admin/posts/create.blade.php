@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
        @include('include.form_error')
    </div>
    </div>
    <div class="row">
     {!! Form::open(['action'=>'AdminPostsController@store' , 'method'=>'POST' , 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title : ') !!}
            {!! Form::text('title',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category : ') !!}
            {!!  Form::select('category_id', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Choose
            Category' , 'class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo : ') !!}
            {!! Form::file('photo_id' , ['class'=>'']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Description : ') !!}
            {!! Form::textarea('body',null ,['class'=>'form-control']) !!}
        </div>

    {!! Form::submit('Create Post' , ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
    </div>
@endsection


@section('footer')

@endsection

