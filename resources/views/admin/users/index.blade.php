@extends('layouts.admin')


@section('content')
    <h1>Create Users </h1>
    <table class="table">
            <thead>
                <tr>
                    <th>id</th>
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
                    <td>{{$user->name}}</td>
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