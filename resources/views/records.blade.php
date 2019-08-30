@extends('layouts.app')


@section('content')
    <div class="container">
        <records-component datachunks="{{json_encode($chunks)}}" datatypes="{{json_encode($types)}}">Loading... please wait</records-component>
    </div>
@endsection
