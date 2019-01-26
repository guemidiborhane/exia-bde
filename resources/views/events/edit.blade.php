@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('events.update', ['event' => $event]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('events._form')
                </form>
            </div>
        </div>
    </div>
@endsection
