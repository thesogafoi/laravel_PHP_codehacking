@extends('layouts.admin')
@section('message')
    @if(\Illuminate\Support\Facades\Session::has('post_deleted'))
        <p style="font-size : 1.8rem;font-weight: bold;padding:20px; margin-top:5px !important; background: rgba(204, 40, 40, 0.52);
    color:#ad2c2c;    border-radius: 19px; border: 2px solid black;"
           class="bg-danger text-center">{{session('post_deleted')}}</p>
    @endif()
@endsection
@section('content')
    <h1>Create posts </h1>
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Body</th>
            <th>Owner</th>
            <th>Photo</th>
            <th>Category</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
               <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->photo->file}}</td>
                <td>{{$post->category_id}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection