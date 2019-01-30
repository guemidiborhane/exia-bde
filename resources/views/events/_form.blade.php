@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Auth::user()->hasRole('bde') && $event->user_id)
    <h5 class="text-center">Author : {{ $event->author->fname }} {{ $event->author->lname }}</h5>
    <hr>
@endif

<div class="form-group row">
    <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nom de l\'évènement') }}</label>

    <div class="col-md-8">
        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $event->name) }}" required autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="planned_on" class="col-md-3 col-form-label text-md-right">{{ __('Prévu le') }}</label>

    <div class="col-md-8">
        <input id="planned_on" type="date" class="form-control {{ $errors->has('planned_on') ? ' is-invalid' : '' }}" name="planned_on" value="{{ old('planned_on', optional($event->planned_on)->format('Y-m-d')) }}" required autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

    <div class="col-md-8">
        <textarea rows="4"
            id="description"
            type="text"
            class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
            name="description"
            required autofocus>{{ old('description', $event->description) }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-md-3 col-form-label text-md-right">{{ __('Image à la une') }}</label>
    <div class="col-md-5">
        <input id="image" type="file" name="image" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}">
    </div>
@if (Auth::user()->hasRole('bde'))
    <div class="custom-control custom-checkbox align-self-center col-md-4">
        <input id="status" type="checkbox" class="custom-control-input {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" {{ $event->status ? 'checked' : '' }}>
        <label class="custom-control-label" for="status">{{ __('Boite à idée?') }}</label>
    </div>
@endif
</div>


@if (Route::currentRouteName() === 'events.edit' && Auth::user()->hasRole('bde'))
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-3">
        @include('shared.dropzone')
    </div>
</div>
@endif
<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-3">
        <button type="submit" class="btn btn-primary btn-block">
            {{ __('Enregistrer') }}
        </button>
    </div>
</div>

