@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
@endsection


@section('content')
    <h1>Upload Media</h1>
     {!! Form::open(['action'=>'AdminMediaController@upload' , 'method'=>'POST' , 'class'=>'dropzone']) !!}
      {!! Form::close() !!}
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@endsection