@extends('students.layout')
@section('content')
 
<div class="card">
  <div class="card-header">Tracks Page</div>
  <div class="card-body">
      <form action="{{ url('tracks') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <label>Name</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>About</label></br>
        <input type="text" name="about" id="about" class="form-control"></br>
        <label>logo</label></br>
        <input type="file" name="logo" id="logo" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@endsection
