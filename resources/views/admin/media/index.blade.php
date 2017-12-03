@extends('layouts.admin')
@section('styles')
        <style>
            .image {
                cursor: pointer;
            }

        </style>
    @endsection
@section('content')
    <form action="delete/media" method="post">
        {{csrf_field()}}
        {{method_field('delete')}}
<button type="submit" name="multi_delete" class="btn btn-primary pull-right">Submit</button>
         <select name="doWork" id="" class="pull-right" style="margin-right: 20px;">
            <option value="delete">Delete</option>
        </select>
        <p  style="margin-right: 20px;"class="pull-right">Select All <input class="selectAll" type="checkbox" name="selectAll"></p>
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
                        <div style="float: left; padding: 10px; margin: 10px;width: 200px;height: 200px;" class="img-responsive">


                                <img class="image " src="{{$path}}" class="img-responsive" alt="" height="200"
                                     width="200">

                            {{--<img src="https://png.icons8.com/?id=56992&size=280" alt="" height="200" width="200"--}}
                                 {{--style="position:absolute; background: white; opacity: 0.2">--}}


                            <input type="checkbox"  name="deleteArray[]" class="deleteArray" style="position:
                            absolute;margin-left: -20px;     " value="{{$key}}">
                        </div>
                 @endif
    @endforeach
    </form>
@endsection
   @section('scripts')
       <script>
           $(document).ready(function(){
                $('.image').click(function () {
                    var checkattr = $(this).next().prop('checked');
                    if(checkattr === true){
                        $(this).next().prop('checked' , false);

                    }else if (checkattr === false){
                        $(this).next().prop('checked' , true);

                    }
                });
                $('.selectAll').change(function () {
                    var checkattr = $(this).prop('checked');
                    if(checkattr === true){
                        $('.deleteArray').prop('checked' , true);

                    }else if (checkattr === false){
                        $('.deleteArray').prop('checked' , false);

                    }
                });
           });
       </script>
    @endsection

@section( 'footer')
@endsection

