@extends('layouts.app')


@section('content')
    <div class="container" id="create-chunk-form">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-type">Type</span>
            </div>
            <input type="text"
                   name="type"
                   class="form-control"
                   placeholder="Type"
                   aria-label="Type"
                   value="{{$chunk->type}}">

            <div class="dropdown">
                <button class="btn btn-secondary btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                    Type
                </button>
                <div class="dropdown-menu select-type" aria-labelledby="dropdownMenuButton">
                    @if($types)

                        @foreach($types as $type)
                            <span class="dropdown-item " data-type="{{$type->type}}">{{$type->type}}</span>
                        @endforeach

                    @endif
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-title">Title</span>
            </div>
            <input type="text"
                   name="title"
                   class="form-control"
                   placeholder="Title"
                   aria-label="Title"
                   aria-describedby="basic-title"
                   value="{{$chunk->title}}" >
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">With textarea</span>
            </div>
            <textarea
                name="body"
                class="form-control"
                aria-label="With textarea">{{$chunk->body}}</textarea>
        </div>

        <div class="table-grid">
            <div class="dropdown">
                <button class="btn btn-secondary {{$chunk->status ? 'btn-dark' : 'btn-danger'}}  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                    Status <span data-status-change></span>
                </button>
                <div class="dropdown-menu select-status" aria-labelledby="dropdownMenuButton">
                    <span class="dropdown-item " data-status="1">Active</span>
                    <span class="dropdown-item " data-status="0">Disable</span>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-primary save" type="button">
                    Save changes
                </button>
            </div>
        </div>

        <chunkform></chunkform>

    </div>
@endsection
