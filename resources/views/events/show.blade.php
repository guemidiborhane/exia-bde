@extends('layouts.app')

@section('content')
    <div class="w-100" style="height: 350px">
        <div class="event-image-bg" style="background-image: url('{{ asset('storage/photos/'.$event->image) }}')"></div>
    </div>
    <div class="container mt-4">
        <h1 class="h1 text-center">
            {{ $event->name }}
            <p class="badge badge-{{ ($event->passed) ? 'success' : 'danger' }}">
                {{ $event->planned_on->format('d M Y') }}
            </p>
        </h1>
        @auth
            @if (Auth::user()->hasRole('bde'))
                <a href="{{ route('events.edit', compact('event')) }}" class="btn btn-success btn-sm">
                    <i class="fa fa-pen"></i>
                </a>
            @endif
        @endauth
        <p class="mt-4 event-description">{{ $event->description }}</p>
        <h5 class="my-5">
            Photos <i class="fa fa-thumbs-up"></i>
            @auth
                @if ($event->status === null &&
                    (Auth::user()->hasRole('bde') ||
                    json_decode($event->participates) ||
                    $event->user_id === Auth::user()->id))
                    <a href="{{ route('uploads.create', compact('event')) }}" class="btn btn-link text-right">Ajouter des photos</a>
                @endif
            @endauth
        </h5>
        @if ($event->photos()->count())
            <div class="photos-container">
            @foreach ($event->photos as $photo)
                <a href="{{ asset('storage/photos/' . $photo->filename) }}" target="_blank" class="mx-2">
                    <img src="{{ asset('storage/photos/' . $photo->filename) }}" alt="Photo" width="150">
                </a>
            @endforeach
            </div>
        @endif
        <h5 class="text-right my-5">
            Commentaires <i class="fa fa-comment"></i>
        </h5>
        <comments-component
        @auth
        user-id="{{ Auth::user()->id }}"
        @endauth
            model="{{ get_class($event) }}"
            :comments='{{ json_encode($event->comments()->with('user:id,fname,lname')->latest()->get()) }}'
            submit-url="{{ route('comments.store', ['id' => $event->id]) }}"
            delete-url="{{ route('comments.destroy') }}"></comments-component>
    </div>
@endsection
