@extends('layouts.app')

@section('content')
    {{-- @include('shared.carousel') --}}
    <div class="container my-4">
    @if (sizeof($events) && ($events[0]->status !== null && Route::currentRouteName() === 'events'))
        <blockquote class="blockquote text-center">
            A participation = A vote <i class="fa fa-heart text-danger"></i>
        </blockquote>
    @endif
    @auth
        <div class="col-md-12 text-right px-0">
            <a href="{{ route('events.create') }}" class="btn btn-primary bg-primary mb-2 text-right">Add</a>
        </div>
    @endauth
        <ul class="list-unstyled">
            @foreach($events as $event)
                @include('events.event')
            @endforeach
        </ul>
    </div>
@endsection
