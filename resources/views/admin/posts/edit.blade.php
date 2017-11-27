@extends('layouts.admin')

@section('content')

    <h1>Edit Posts </h1>
    <div class="col-sm-6 col-lg-offset-3">
        <div style="text-align: center">
            <img class="img-responsive"  src="{{$post->photo_id ? $post->imagePostPath():'https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/2383454/580/386/m1/fpnw/wm0/creative-24-.png?1489056658&s=c0c68cb152372f5b66acee0ce60178ee'}}" alt="">
        </div>
        @if(count($errors) > 0)
            <div style="color: darkred;">
                <h5 class="center-block text-center">we have some error</h5>
                @include('include.form_error')
            </div>
        @endif
    </div>
    <div class="col-sm-12">




        {!! Form::model($post , ['action'=>['AdminPostsController@update' , $post->id],'method'=>'PATCH' , 'files'=>true] ) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title : ', ['class' => 'awesome']) !!}
            {!! Form::text('title',null ,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category : ') !!}
            {!!  Form::select('category_id', $categories, null, ['placeholder' => 'Choose Category' , 'class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo : ') !!}
            {!! Form::file('photo_id' , ['class'=>'']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Description : ') !!}
            {!! Form::textarea('body',null ,['class'=>'form-control']) !!}
        </div>


        <div class="col-md-6">
            <div class="form-group">
                {!! Form::submit('Update post' , ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            {!! Form::open(['action'=>['AdminPostsController@destroy' , $post->id], 'method'=>'DELETE' ,'files'=>true])!!}
            {!! Form::submit('Delete post' , ['class' => 'btn btn-danger form-control']) !!}
            {!! Form::close() !!}
        </div>


    </div>
@endsection