@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('include.form_error')
            {!! Form::model($cat , ['action'=>['AdminCategoriesController@update' , $cat->id],'method'=>'PATCH' ]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Category Name : ', ['class' => 'awesome']) !!}
                {!! Form::text('name',null ,['class'=>'form-control']) !!}
            </div>
            <div class="col-md-6">
            <div class="form-group">
                {!! Form::submit('Create Category' , ['class' => 'btn btn-primary form-control']) !!}
            </div>
            </div>
            {!! Form::close() !!}
            <div class="col-md-6">
            {!! Form::model($cat , ['action'=>['AdminCategoriesController@destroy' , $cat->id],'method'=>'DELETE' ]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Category' , ['class' => 'btn btn-danger form-control']) !!}
            </div>
            {!! Form::close() !!}
            </div>
        </div>

@endsection
@section('footer')
@stop