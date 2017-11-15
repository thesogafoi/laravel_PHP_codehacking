@extends('layouts.admin')


@section('content')
    <h1>Create Users </h1>
    <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Photo</th>
                    <th>name</th>
                    <th>email</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('admin.users.edit' , $user->id)}}"><img height="50" src="{{$user->photo_id ? $user->imagePath(): 'https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/2383454/580/386/m1/fpnw/wm0/creative-24-.png?1489056658&s=c0c68cb152372f5b66acee0ce60178ee'}}" alt=""></a></td>
                    <td><a href="{{route('admin.users.edit' , $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td><?php echo $user->is_active == 1  ? "<p class='bg-active'>Active User</p>" : "<p
                        class='bg-deactive'>Not Active User</p>"?></td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

@endsection