@extends('students.layout')
@section('content')
<div class="card">
  <div class="card-header">Students Page</div>
  <div class="card-body">


    <div class="card-body d-flex">
      <div class="w-75">
      <h5 class="card-title">Name : {{ $students->name }}</h5>
      <p class="card-text my-1">Email: {{$students->email}}</p>
      <p class="card-text my-1">Age: {{$students->age}}</p>
      <p class="card-text my-1">Mobile: {{$students->mobile}}</p>
      <p class="card-text my-1">Gender: {{$students->gender}}</p>
      <p class="card-text my-1">Address: {{$students->address}}</p>
      <p class="card-text my-1">Track: {{$students->track}}</p>
      </div>
      <div class="w-25"><img src="{{asset($students->img)}}" class="card-img-top w-100" alt="..."></div>
    </div>

    </hr>

  </div>
</div>
@endsection