@extends('layouts.app')


@section('content')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div class="dashboard-grid p-2">
                        <div class="company">
                            <div class="card">
                                <div class="card-header bg-dark text-light">company</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Company: <span>{{ $company }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="domain">
                            <div class="card">
                                <div class="card-header bg-dark text-light">domain</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Domain: <span>{{ $domain }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class=""></div>
                        <div class="profile">
                            <div class="card">
                                <div class="card-header bg-dark text-light">profile</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Name: <span>{{ $name }}</span></li>
                                        <li class="list-group-item">Email: <span>{{ $email }}</span></li>
                                        <li class="list-group-item">Created: <span>{{ $created_at }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
