@extends('layouts.admin')


@section('content')
    <div class="row">
        @include('include.form_error')
        <div class="col-md-6">
             {!! Form::open(['action'=>'AdminCategoriesController@store' , 'method'=>'POST' , 'files'=>false]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Category Name : ', ['class' => 'awesome']) !!}
                {!! Form::text('name',null ,['class'=>'form-control']) !!}
            </div>
                <div class="form-group">
                    {!! Form::submit('Create Category' , ['class' => 'btn btn-primary form-control']) !!}
                </div>
              {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cats as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td><a href="{{route('admin.categories.edit' , $cat->id )}}">{{$cat->name}}</a></td>
                        <td>{{$cat->created_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
@stop