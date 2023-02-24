@extends('layout.app')
@section('content')


<div class="container" style="margin-top: 30px;">

    <div class="col-4">

        @foreach($teachers as $teacher)
            <div class="card" style="width: 18rem; margin:10px">
                <img src="{{ $teacher->image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">{{ $teacher->name }}</p>
                    <p class="card-text">{{ $teacher->email }}</p>
                    <p class="card-text">{{ $teacher->speciality }}</p>
                </div>
            </div>
        @endforeach

    </div>
    </div>


@endsection
