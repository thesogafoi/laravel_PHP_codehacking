@extends('layouts.admin')

@section('content')
    @if(count($comments) > 0)
        <h1 class="text-center">Comments For {{$post->title}}</h1>
        <br>
        @if(\Illuminate\Support\Facades\Session::has('comment_message'))
            <h4 style="color: #080808" class="text-center">{{session('comment_message')}}</h4><br>
            <hr>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Comment For</th>
                <th>Submitted At</th>
                <th>Change Status</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post' , $comment->post->id)}}">{{$comment->post->title}}</a></td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>
                        @if($comment->is_active == 1)
                            {!! Form::open(['action'=>['AdminCommentsController@update' , $comment->id]  ,
                            'method'=>'PATCH' ]) !!}
                            {!! Form::submit('Un-Approve' , ['class' => 'btn btn-info']) !!}
                            <input type="hidden" value='0' name="is_active">
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['action'=>['AdminCommentsController@update' , $comment->id], 'method'=>'PATCH',
                            $comment->id]) !!}
                            <input type="hidden" value='1' name="is_active">
                            {!! Form::submit('Approve' , ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>


                    <td>
                        {!! Form::open(['action'=>['AdminCommentsController@destroy' , $comment->id],
                        'method'=>'DELETE',
                           $comment->id]) !!}
                        {!! Form::submit('Delete' , ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            @else
                <h1 class="text-center" style="color: darkred">No Comment Here</h1>
    @endif
@endsection

