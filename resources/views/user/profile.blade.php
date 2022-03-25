@extends('layout.app')

@section('main')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between gap-3">
            <h1 class="mb-0">{{ auth()->user()->name }}</h1>
            <a class="btn btn-outline-danger" href="{{ route('user.logout') }}">Logout</a>
        </div>
        <p class="lead">{{ auth()->user()->email }}</p>
    </div>
@endsection
