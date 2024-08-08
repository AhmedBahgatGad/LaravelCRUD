@extends('students.layout')
@section('content')
 
<div class="card">
  <div class="card-header">Contactus Page</div>
  <div class="card-body">
      
      <form action="{{ url('tracks/' .$track->id) }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @method("PUT")
        <input type="hidden" name="id" id="id" value="{{$track->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$track->name}}" class="form-control"></br>
        <label>Desc</label></br>
        <input type="text" name="about" id="about" value="{{$track->about}}" class="form-control"></br>
        <label>img</label></br>
        <input type="file" name="img" id="img" class="form-control"></br>
        <input type="submit" value="update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@endsection