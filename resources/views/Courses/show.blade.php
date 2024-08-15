@extends('students.layout')
@section('content')
<div class="card">
  <div class="card-header">course Page</div>
  <div class="card-body">


    <div class="card-body d-flex">
      <div class="w-75">
      <h5 class="card-title">Name : {{ $course->name }}</h5>
      <p class="card-text my-1">Total Grade : {{$course->totalGrade}}</p>
      <p class="card-text my-1">Description : {{$course->description}}</p>
      </div>
      <div class="w-25"><img src="{{asset($course->logo)}}" class="card-img-top w-100" alt="..."></div>
    </div>

    </hr>

  </div>
</div>
@endsection