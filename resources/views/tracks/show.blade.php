@extends('students.layout')
@section('content')
<div class="card">
  <div class="card-header">track Page</div>
  <div class="card-body">


    <div class="card-body d-flex">
      <div class="w-75">
      <h5 class="card-title">Name : {{ $track->name }}</h5>
      <p class="card-text my-1">About: {{$track->about}}</p>
      </div>
      <div class="w-25"><img src="{{asset($track->logo)}}" class="card-img-top w-100" alt="..."></div>
    </div>

    </hr>

  </div>
</div>
@endsection