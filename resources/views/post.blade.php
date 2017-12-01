@extends('layouts.blog-post')
@section('style')
    <style>
            .toggle-replay{
                margin-bottom: 25px;
            }
    </style>

    @endsection
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
        @if(\Illuminate\Support\Facades\Session::has('comment_message') || \Illuminate\Support\Facades\Session::has('replay_message'))
            <p class="bg-info text-center">{{session('comment_message')}}</p>
                <p class="bg-info text-center">{{session('replay_message')}}</p>
            @endif
        @else
           <p class="text-center>"> <a href="{{url('login')}}" >U cannot leave Comment Go to Login</a></p>
        @endif

    </div>
    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @if(count($comments) > 0)


@foreach($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img width='64'class="media-object" src="{{$comment->user->photo_id ?'/images/'.$comment->user->email.'/'
            .$comment->user->photo->file:'http://placehold.it/64x64'}}"alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->user->name}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
           {{$comment->body}}
            <button class="btn btn-primary pull-right toggle-replay">Replay Comment</button>
            <div class="replay-section" style="display: none;">
            {!! Form::open(['action'=>'CommentRepliesController@createReplay' , 'method'=>'POST' ]) !!}
            <input type="hidden" name="comment_id" value="{{$comment->id}}">
            <div class="form-group">
                {!! Form::text('body',null ,['class'=>'form-control','rows'=>1 , 'placeholder','You Replay']) !!}
            </div>
            {!! Form::submit('Create Replay' , ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            </div>
        @if(count($comment->replies) > 0)
            @foreach( $comment->replies()->where('is_active','1')->orderBy('id')->get() as $replay)
        <!-- Nested Comment -->
            <div class="media nested-comment">
                <a class="pull-left" href="#">
                    <img width='64'class="media-object" src="{{$replay->user->photo_id ?'/images/'.$replay->user->email.'/'
            .$replay->user->photo->file:'http://placehold.it/64x64'}}"alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$replay->user->name}}
                        <small>{{$replay->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$replay->body}}

                </div>
            </div>
            <!-- End Nested Comment -->
            @endforeach
            @endif
        </div>
    </div>
    <hr>
@endforeach
    @endif
    <!-- Comment -->


@stop

@section('scripts')
    <script>
           $(".toggle-replay").click( function(){
                $(this).next().fadeToggle('slow');
           });
    </script>
    @endsection