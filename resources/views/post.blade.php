@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#"> {{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img src="{{$post->photo ? '/images/'.$post->user->email.'/'.$post->photo->file :'http://placehold.it/900x300'}}"
         alt="" class="img-responsive">

    <hr>

    <!-- Post Content -->

    <p id="hooked">{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
    @if(\Illuminate\Support\Facades\Auth::check())

        <h4>Leave a Comment:</h4>
         {!! Form::open(['action'=>'AdminCommentsController@store' , 'method'=>'POST' , 'files'=>false ,
         'id'=>'form'])
          !!}
        <div class="form-group ">
            {!! Form::label('Body', 'Fill Your Comment', ['class' => 'awesome']) !!}
            {!! Form::textarea('body',null ,['class'=>'form-control' , 'rows'=>5 ]) !!}
        </div>
                <input type="hidden" value="{{$post->id}}" name="post_id">

                {!! Form::submit('Submit Ur Comment' , ['class' => 'btn btn-primary']) !!}

          {!! Form::close() !!}
        <br><br>
        @if(\Illuminate\Support\Facades\Session::has('comment_message') || \Illuminate\Support\Facades\Session::has('Replay_message'))
            <p class="bg-info text-center">{{session('comment_message')}}</p>
            @endif
        @else
           <p class="text-center>"> <a href="{{url('login')}}" >U cannot leave Comment Go to Login</a></p>
        @endif

    </div>
    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @if(count($comments) > 0)

        @endif
@foreach($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img width='64'class="media-object" src="{{$user->photo_id ?'/images/'.$user->email.'/'
            .$user->photo->file:'http://placehold.it/64x64'}}"alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$user->name}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
           {{$comment->body}}

        <!-- Nested Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                     {!! Form::open(['action'=>'CommentRepliesController@createReplay' , 'method'=>'POST' ]) !!}
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <div class="form-group">
                            <label for="body">body</label>
                            {!! Form::text('body',null ,['class'=>'form-control','rows'=>1]) !!}
                        </div>
                        {!! Form::submit('Create Replay' , ['class' => 'btn btn-primary']) !!}
                      {!! Form::close() !!}
                </div>
            </div>
            <!-- End Nested Comment -->
        </div>
    </div>
    <hr>
@endforeach
    <!-- Comment -->


@stop