@extends('layouts.admin')

@section('content')
    <h1>All Media</h1>
    <h2 class="text-center bg-primary">Images For : {{$user->name}}</h2>
    @if(Session::has('image_deleted'))
        <h3 class="text-center bg-danger" style="padding: 5px; background: darkred;color: whitesmoke;">{{session('image_deleted')}}</h3>
    @endif
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
                        <div style="float: left; padding: 10px; margin: 10px;width: 200px;height: 200px;"
                             class="img-responsive">
                            <img src="{{$path}}" class="img-responsive" alt="" height="200" width="200">
                            {!! Form::model($photo, ['action'=>['AdminMediaController@destroy',$key], 'method'=>'DELETE']) !!}
                            {!! Form::submit('Delete Photo' , ['class' => 'btn btn-danger form-control']) !!}
                            {!! Form::close() !!}
                        </div>
                 @endif
    @endforeach
@endsection

@section( 'footer')
@endsection