@extends('layouts.app')

@section('content')
    @include('shared.carousel')
    <div class="container">
        <hr class="my-4">
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
            <div class="card bg-dark pt-4 pb-2">
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
