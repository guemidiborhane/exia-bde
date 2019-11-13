@extends('layouts.app')

@section('content')
<div class="container-fluid px-5 mt-2" id="app">
    <div class="d-flex row event-container ">
        <div class="col-md-4 px-0" style="overflow: hidden">
            <div class="image-container" style="background-image: url('{{ asset('storage/photos/'.$event->image) }}')"></div>
        </div>
        <div class="col-md-8 pt-4 pl-4">
            <h1 class="h1 text-center">
                {{ $event->name }}
            </h1>
            <div class="text-center">
                <p class="badge badge-light text-{{ ($event->passed) ? '' : 'danger' }}">
                    {{ $event->planned_on->format('d M Y') }}
                </p>
                @auth
                <likes-component
                        :event-id="{{ $event->id }}"
                        :liked="{{ ($event->liked) ? 'true' : 'false' }}"
                        :likes-count="{{ $event->likeCount }}"
                        submit-route="{{ route('toggleLike', compact('event')) }}"></likes-component>
                @endauth
            </div>
            @auth
                @if (Auth::user()->hasRole('bde'))
                    <a href="{{ route('events.edit', compact('event')) }}" class="btn btn-link edit-btn">
                        <i class="fa fa-pen"></i>
                        {{ __('Edit') }}
                    </a>
                @endif
            @endauth
            <hr>
            <p class="mt-4 event-description">{!! nl2br(e($event->description)) !!}</p>
            <h5 class="my-5">
                Photos
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

        <h5 class="text-right mb-5">
            Commentaires <i class="fa fa-comment"></i>
        </h5>
        <comments-component
        @auth
        user-id="{{ Auth::user()->id }}"
        user-role="{{ Auth::user()->role }}"
        @endauth
            model="{{ get_class($event) }}"
            :comments='{{ json_encode($event->comments()->with('user:id,fname,lname')->latest()->get()) }}'
            submit-url="{{ route('comments.store', ['id' => $event->id]) }}"
            delete-url="{{ route('comments.destroy') }}"></comments-component>
        </div>
    </div>
</div>
@endsection
