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
                    <td style="vertical-align: middle"><a href="{{ route('events.show', compact('event')) }}" class="text-white event-show-link">{{ $event->name }}</a></td>
                    <td style="vertical-align: middle; text-align: justify">{{ str_limit($event->description, 160, ' (...)') }}</td>
                    <td style="vertical-align: middle">{{ $event->planned_on->format('d M Y') }}</td>
                    <td style="vertical-align: middle" class="text-center">{{ $event->participants()->count() }}</td>
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

        <hr class="my-4">
        <h2 class="text-center">Commentaires</h2>


        <div class="card-columns">
        @foreach ($comments as $comment)
        <div class="card comment">
            <div class="card-body">
                <p class="card-text mb-4">{{ str_limit($comment->body, 160, ' (...)') }}</p>
                <p class="card-title">
                    {{ ucfirst($comment->user->fname) }} {{ $comment->user->lname }}
                    <img src="{{ get_gravatar($comment->user->email) }}" alt="avatar" class="avatar">
                </p>
                <p class="card-subtitle mb-2 text-muted">
                    {{ $comment->user->campus }} &middot; <a href="{{ route('events.show', ['id' => $comment->commentable->id]) }}">{{ $comment->commentable->name }}</a>
                </p>
            </div>
        </div>
        @endforeach
        </div>
    </div>


@endsection
