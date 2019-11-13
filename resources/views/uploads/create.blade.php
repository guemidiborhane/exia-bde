@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('events.show', compact('event')) }}" class="btn btn-link">Go back to the event</a>
        @include('shared.dropzone')
    </div>
@endsection
