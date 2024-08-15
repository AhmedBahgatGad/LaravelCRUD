@extends('students.layout')
@section('content')
<div class="row">
@foreach($courses as $course)
<div class="col-md-3">
<div class="card bg-dark my-2 border border-rounded text-white">
    <div style="height: 250px; overflow:hidden;"><img src="{{asset($course->logo)}}" class="card-img-top w-100" alt="..."></div>
    <div class="card-body">
        <h5 class="card-title">{{$course->name}}</h5>
        <div class="my-4">
            <p class="card-text my-1">Total Grade : {{$course->totalGrade}}</p>
            <p class="card-text my-1">Desc : {{$course->description}}</p>
        </div>
        <div class="text-end">
            <a href="{{ url('/course/' . $course->id . '/edit') }}" title="Edit course"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            <form method="POST" action="{{ url('/course' . '/' . $course->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete course"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <a href="{{ url('/course/' . $course->id) }}" title="View course"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
        </div>
    </div>
</div>
</div>
@endforeach
</div>
@endsection