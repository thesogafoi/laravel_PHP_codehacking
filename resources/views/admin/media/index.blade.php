@extends('layouts.admin')

@section('content')
    <h1>All Media</h1>
    <h2 class="text-center bg-primary">Images For : {{$user->name}}</h2>
    <?php
    $photos1 = [];
    foreach($photos as $photo){
    	$photos1 [$photo->id] = $photo->file;
    }
    $photos1 = array_unique($photos1);

    ?>
    @foreach($photos1 as $key=>$photo)

                   @if(file_exists(public_path().'/images/'.$user->email.'/'.$photo))
                       <?php $path = '/images/'.$user->email.'/'.$photo ; ?>
                        <div class="col-sm-3">
                            <img src="{{$path}}" class="img-responsive" alt="">
                            {!! Form::model($photo, ['action'=>['AdminMediaController@destroy',$key], 'method'=>'DELETE']) !!}
                            {!! Form::submit('Delete Photo' , ['class' => 'btn btn-danger form-control']) !!}
                            {!! Form::close() !!}
                        </div>
                 @endif
    @endforeach
@endsection

@section( 'footer')
@endsection