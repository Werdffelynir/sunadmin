@extends('layouts.app')


@section('content')
    <div class="container">
        <form action="/api/email" method="post" enctype="multipart/form-data">
            <div>
                <input type="text" name="subject" value="some subject" id="">
            </div>
            <div>
                <input type="text" name="message" value="some message">
            </div>
            <div>
                <input type="file" name="file" id="">
            </div>
            <div>
                <input type="submit" value="Send Email">
            </div>
        </form>
    </div>
@endsection
