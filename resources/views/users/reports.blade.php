@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <table id="reports-table" class="display table table-borderless table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Type</th>
                <th>Definition</th>
                <th>Autor</th>
                <th colspan="2" class="text-center">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr id="event-item-{{$event->id}}">
                    <td>EVENT</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->author->fname }} {{ $event->author->lname }}</td>
                    <td class="text-center">
                        <a href="{{ route('events.restore', compact('event')) }}"
                            onclick="event.preventDefault();
                            axios.put(event.target.getAttribute('href')).then(function () {
                                let item = document.querySelector('#event-item-{{$event->id}}');
                                item.parentNode.removeChild(item);
                            })">Restore</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('events.destroy', compact('event')) }}"
                            onclick="event.preventDefault();
                                axios.delete(event.target.getAttribute('href')).then(function () {
                                    window.location = '/mib';
                                })">Men in Black</a>
                    </td>
                </tr>
            @endforeach
            @foreach ($comments as $comment)
                <tr id="comment-item-{{$comment->id}}">
                    <td>Comments</td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->user->fname }} {{ $comment->user->lname }}</td>
                    <td class="text-center">
                        <a href="{{ route('comments.restore', compact('comment')) }}"
                            onclick="event.preventDefault();
                                axios.put(event.target.getAttribute('href')).then(function () {
                                    let item = document.querySelector('#comment-item-{{$comment->id}}');
                                    item.parentNode.removeChild(item);
                                })">Restore</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('comments.destroy', compact('comment')) }}"
                            onclick="event.preventDefault();
                            axios.delete(event.target.getAttribute('href')).then(function () {
                                window.location = '/mib'
                            })">Men in Black</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#reports-table').DataTable({
                "columns": [
                    null,
                    null,
                    null,
                    { "orderable": false },
                    { "orderable": false },
                ]
            });
        });
    </script>
@endsection
