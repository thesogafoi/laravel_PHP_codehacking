@extends('layouts.admin')
@section('message')
    @if(\Illuminate\Support\Facades\Session::has('post_deleted'))
        <p style="font-size : 1.8rem;font-weight: bold;padding:20px; margin-top:5px !important; background: rgba(204, 40, 40, 0.52);
    color:#ad2c2c;    border-radius: 19px; border: 2px solid black;"
           class="bg-danger text-center">{{session('post_deleted')}}</p>
    @endif()
@endsection
@section('content')
    <h1>All  posts </h1>
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Body</th>
            <th>Owner</th>
            <th>Category</th>
            <th> Comments</th>
            <th> View Post </th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
               <td>{{$post->id}}</td>
                <td><a href="{{route('admin.post.edit' , $post->id)}}"><img height="50" src="{{$post->photo_id?$post->imagePostPath(): 'https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/2383454/580/386/m1/fpnw/wm0/creative-24-.png?1489056658&s=c0c68cb152372f5b66acee0ce60178ee'}}" alt=""></a></td>
                <td><a href="{{route('admin.post.edit' , $post->id)}}">{{$post->title}}</a></td>
                <td>{{str_limit($post->body , 30)}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category ? $post->category->name : 'uncategorized'}}</td>
                <td><a href="{{route('admin.post.show' , $post->id)}} "><i style="background:
                    #ffae62;padding: 10px; color: white;text-decoration: none;border-radius: 20px;">{{count
                    ($post->comments)}}</i> </a></td>
                <td><a href="{{route('home.post' , $post->slug)}} ">View Post </a></td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="row">
        <div class="col-md-4 col-md-offset-5">
            {{$posts->render()}}
        </div>
    </div>
@endsection

