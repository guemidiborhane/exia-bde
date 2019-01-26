@extends('layouts.app')

@section('content')
    @include('shared.carousel')
    <div class="container">
        <hr class="my-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if (sizeof($coming_events))
        <h2 class="text-center">Évènements prevu cette semaine</h2>
        <table class="table table-dark table-striped table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col" style="width: 15%">Titre</th>
                    <th scope="col" style="width: 60%">Description</th>
                    <th scope="col" style="width: 15%">Date</th>
                    <th scope="col" class="text-center">Participants</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($coming_events as $event)
                <tr>
                    <td><a href="{{ route('events.show', compact('event')) }}" class="text-white event-show-link">{{ $event->name }}</a></td>
                    <td>{{ str_limit($event->description, 160, ' (...)') }}</td>
                    <td>{{ $event->planned_on->format('d M Y') }}</td>
                    <td class="text-center">{{ $event->participants()->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <div class="card bg-dark pt-4">
                <h5 class="text-white text-center">
                    Rien de prévu cette semaine,
                </h5>
                <h1 class="text-white text-center">
                    but come back tomorrow !
                </h1>
            </div>
        @endif
    </div>
@endsection
