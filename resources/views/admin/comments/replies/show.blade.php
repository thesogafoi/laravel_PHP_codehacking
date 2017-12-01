@extends('layouts.admin')

@section('content')
    @if(count($replies) > 0)
        <h4 class="text-center">Replies For <i style="font-size:2.5rem; color:darkred;"> " {{$comment->body}} "</i>
            Post</h4>
        <br>
        @if(\Illuminate\Support\Facades\Session::has('replay_message'))
            <h4 style="color: #080808" class="text-center">{{session('replay_message')}}</h4><br>
            <hr>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Replay For</th>
                <th>Submitted At</th>
                <th>Change Status</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $replay)

                <tr>
                    <td>{{$replay->id}}</td>
                    <td>{{$replay->author}}</td>
                    <td>{{$replay->email}}</td>
                    <td>{{$replay->body}}</td>
                    <td><a href="{{route('home.post' , $replay->comment->post->slug)
                    }}">{{$replay->comment->post->title}}</a></td>
                    <td>{{$replay->created_at->diffForHumans()}}</td>
                    <td>
                        @if($replay->is_active == 1)
                            {!! Form::open(['action'=>['CommentRepliesController@update' , $replay->id]  ,
                            'method'=>'PATCH' ]) !!}
                            {!! Form::submit('Un-Approve' , ['class' => 'btn btn-info']) !!}
                            <input type="hidden" value='0' name="is_active">
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['action'=>['CommentRepliesController@update' , $replay->id], 'method'=>'PATCH',
                            $comment->id]) !!}
                            <input type="hidden" value='1' name="is_active">
                            {!! Form::submit('Approve' , ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>


                    <td>
                        {!! Form::open(['action'=>['CommentRepliesController@destroy' , $replay->id],'method'=>'DELETE']) !!}
                        {!! Form::submit('Delete' , ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            @else
                <h1 class="text-center" style="color: darkred">No Replay Here</h1>
    @endif
@endsection

