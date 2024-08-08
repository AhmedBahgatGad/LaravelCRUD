@extends('students.layout')
@section('content')
<div class="row">
@foreach($students as $student)
<div class="col-md-3">
<div class="card bg-dark border border-rounded text-white">
    <div style="height: 250px; overflow:hidden;"><img src="{{asset($student->img)}}" class="card-img-top w-100" alt="..."></div>
    <div class="card-body">
        <h5 class="card-title">{{$student->name}}</h5>
        <div class="my-4">
            <p class="card-text my-1">Age: {{$student->age}}</p>
            <p class="card-text my-1">Mobile: {{$student->mobile}}</p>
            <p class="card-text my-1">Track: {{$student->track}}</p>
        </div>
        <div class="text-end">
            <a href="{{ url('/student/' . $student->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            <form method="POST" action="{{ url('/student' . '/' . $student->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <a href="{{ url('/student/' . $student->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
        </div>
    </div>
</div>
</div>
@endforeach
</div>
@endsection