@extends('students.layout')
@section('content')
 
<div class="card">
  <div class="card-header">Contactus Page</div>
  <div class="card-body">
      
      <form action="{{ url('student/' .$students->id) }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$course->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$course->name}}" class="form-control"></br>
        <label>Total Grade</label></br>
        <input type="number" name="totalGrade" id="totalGrade" value="{{$course->totalGrade}}" class="form-control"></br>
        <label>img</label></br>
        <input type="file" name="logo" id="logo" class="form-control"></br>
        <label>Description</label></br>
        <input type="text" name="description" id="description" value="{{$course->description}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
 
@endsection