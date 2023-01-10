@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="alert alert-danger" role="alert">
            {{ __('Erreur lors de la connextion') }}
        </div>

        <ul class="list-group list-group-flush">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
