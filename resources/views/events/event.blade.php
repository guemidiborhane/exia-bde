<li class="media event-item mb-4" id="event-item-{{$event->id}}">
    <img
        src="{{ ($event->image) ? asset('storage/photos/'.$event->image) : 'https://via.placeholder.com/150?text=IMG' }}"
        class="mr-3 p-2"
        style="width: 150px; height: 150px;"
        alt="{{ $event->name }}">
    <div class="media-body align-self-center">
        <h5 class="pt-2 mt-0">
            <a href="{{ route('events.show', compact('event')) }}" class="event-show-link">
                {{ $event->name }}
            </a>
            <div class="btn-group float-right mr-2" role="group">
            @auth
                <likes-component
                    :event-id="{{ $event->id }}"
                    :liked="{{ ($event->liked) ? 'true' : 'false' }}"
                    :likes-count="{{ $event->likeCount }}"
                    submit-route="{{ route('toggleLike', compact('event')) }}"></likes-component>
                @if (Auth::user()->hasRole('bde') || Auth::user()->events()->where('events.id', $event->id)->exists())
                    <a href="{{ route('events.edit', compact('event')) }}" class="btn btn-success btn-sm">
                        Edit
                    </a>
                @endif
                @if (Auth::user()->hasRole('staff'))
                    <a href="{{ route('events.destroy', compact('event')) }}"
                        class="btn btn-sm btn-danger"
                        onclick="event.preventDefault();
                        axios.delete(event.target.getAttribute('href')).then(function () {
                            let item = document.querySelector('#event-item-{{$event->id}}');
                            item.parentNode.removeChild(item);
                        })">
                        <i class="fa fa-flag"></i>
                    </a>
                    <form id="destroy-form-{{$event->id}}" action="{{ route('events.destroy', compact('event')) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            @endauth
            </div>
        </h5>
        <p class="pr-3">{{ str_limit($event->description, 200, ' (...)') }}</p>
        <div class="row">
            <div class="col-md-4 align-self-center">
                <p class="mb-0">{{ $event->planned_on->diffForHumans() }} <small>({{ $event->planned_on->format('d/m/Y') }})</small></p>
            </div>
            @auth
                <div class="col-md-8 text-right pr-4">
                    @if($event->status === null)
                        @if ($event->planned_on >= today())
                            <participate-component
                                :event-id="{{ $event->id }}"
                                :participates="{{ $event->participates }}"
                                :participants-count="{{ $event->participants()->count() }}"
                                submit-route="{{ route('participate', ['event_id' => $event->id]) }}"></participate-component>
                        @else
                            <span class="btn btn-sm btn-outline-danger disabled">Past Event     </span>
                        @endif
                    @endif
                </div>
            @endauth
        </div>
    </div>
</li>
