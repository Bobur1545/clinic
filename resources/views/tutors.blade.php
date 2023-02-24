@extends('layout.app')
@section('content')


    <div class="container">

        <div class="col-4">

            @foreach($tutors as $tutor)
                <div class="card" style="width:18rem;  margin:10px">
                    <img src="{{ $tutor->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{ $tutor->name }}</p>
                        <p class="card-text">{{ $tutor->tel_number }}</p>
                        <p class="card-text">{{ $tutor->address }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


@endsection
