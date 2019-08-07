@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>chunks</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Type</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Author</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($chunks as $chunk)
                <tr>
                    <th scope="row">{{$chunk->title}}</th>
                    <td>{{$chunk->type}}</td>
                    <td>{{$chunk->created_at}}</td>
                    <td>{{$chunk->updated_at}}</td>
                    <td>{{$chunk->author}}</td>
                    @if($chunk->status)
                        <td>active <a href="/chunk/disable/{{$chunk->id}}">disable</a></td>
                    @else
                        <td>disabled <a href="/chunk/enable/{{$chunk->id}}">enable</a></td>
                    @endif
                    <td><a href="/chunk/edit/{{$chunk->id}}">edit</a> | <a href="/chunk/delete/{{$chunk->id}}">delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="container">
        <div class="row justify-content-left">

        </div>
    </div>
@endsection
