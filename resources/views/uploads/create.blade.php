@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('events.show', compact('event')) }}" class="btn btn-link">Retour à l'évènement</a>
        @include('shared.dropzone')
    </div>
@endsection
