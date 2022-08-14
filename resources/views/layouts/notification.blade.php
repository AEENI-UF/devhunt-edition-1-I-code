@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif

@if (Session::has('notif'))
    <div class="alert alert-primary" role="alert">
        {{ Session::get('notif') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
    </div>

@endif
