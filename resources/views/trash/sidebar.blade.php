{{-- TODO: cretae section --}}

@section('sidebar')
    <div class="">
        <h1>sidebar.blade.php</h1>

        <div class="alert alert-danger">
            <div class="alert-title">{{ $title }}</div>

            {{ $slot }}
        </div>
    </div>
@endsection

{{-- TODO: to visual section --}}
@section('sidebar')
    This is the master sidebar.
@show
