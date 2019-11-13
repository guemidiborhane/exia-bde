@if ($past_events->count())
<div id="carousel" class="carousel slide mb-4" data-ride="carousel">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < $past_events->count(); $i++)
            <li data-target="#carousel" data-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : ''}}"></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach ($past_events as $event)
        <div class="carousel-item">
            <img src="{{ asset('storage/photos/'.$event->image) }}" class="d-block w-100" alt="">
            <div class="carousel-caption d-none d-md-block">
                <h5 class="display-1">
                    <a href="{{ route('events.show', compact('event')) }}" class="event-show-link text-white ">
                        {{ $event->name }}
                    </a>
                </h5>
                <p>{{ str_limit($event->description, 160, ' (...)') }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif

@section('scripts')
    <script>
        document.querySelector('.carousel-inner').firstElementChild.classList.add('active');
    </script>
@endsection
