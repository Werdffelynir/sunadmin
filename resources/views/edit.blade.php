@extends('layouts.app')


@section('content')
    <div class="container">

        <edit-component datachunk="{{ json_encode($chunk) }}" datatypes="{{ json_encode($types) }}"></edit-component>

    </div>
@endsection
