@if(Session::has('message') || Session::has('mess') || Session::has('mess2') || Session::has('mess3'))
    <div class="alert alert-{{ Session::get('alert-type', 'info') == 'error' ? 'danger' : (Session::get('alert-type') == 'warning' ? 'warning' : 'success') }} alert-dismissible fade show" role="alert" style="margin: 20px 0;">
        @if(Session::has('mess'))
            <strong>Success!</strong> {{ Session::get('mess') }}
        @elseif(Session::has('mess2'))
            <strong>Success!</strong> {{ Session::get('mess2') }}
        @elseif(Session::has('mess3'))
            <strong>Attention!</strong> {{ Session::get('mess3') }}
        @else
            <strong>{{ ucfirst(Session::get('alert-type', 'Notification')) }}!</strong> {{ Session::get('message') }}
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 20px 0;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
