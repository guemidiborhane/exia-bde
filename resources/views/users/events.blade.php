@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h5>Participations</h5>
        <hr>
        <ul class="list-unstyled">
            @foreach($participations as $event)
                @include('events.event')
            @endforeach
        </ul>

        <h5>My events</h5>
        <hr>
        <ul class="list-unstyled">
            @foreach($events as $event)
                @include('events.event')
            @endforeach
        </ul>
    </div>
@endsection
