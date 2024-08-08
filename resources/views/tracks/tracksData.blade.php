@extends('students.layout')
@section('content')

<div class="row">
@foreach ($tracks as $track)
<div class="col-md-3">
<div class="card bg-dark border border-rounded text-white">
<div style="height: 250px; overflow:hidden;"><img src="{{asset($track->logo)}}" class="card-img-top w-100" alt="..."></div>
    <div class="card-body">
        <h5 class="card-title">{{$track->name}}</h5>
        <div class="my-4">
            <p class="card-text my-1">About: {{$track->about}}</p>
        </div>
        <div class="text-end">
            <a href="{{ url('/tracks/' . $track->id . '/edit') }}" title="Edit track"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            <form method="POST" action="{{ url('/tracks' . '/' . $track->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete track"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            </form>
            <a href="{{ url('/tracks/' . $track->id) }}" title="View track"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
        </div>
    </div>
</div>
</div>
@endforeach
</div>

@endsection