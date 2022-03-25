@extends('layout.app')

@section('main')
    <div class="container">
        <form action="{{ route('user.register') }}" method="post" novalidate>
            @csrf
            <h1>Register</h1>
            <div class="mb-3">
                <label class="form-label w-100">
                    Full name:
                    <input class="@error('name') is-invalid @enderror form-control" type="text" name="name"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Email:
                    <input class="@error('email') is-invalid @enderror form-control" type="email" name="email"
                           value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label w-100">
                    Password:
                    <input class="@error('password') is-invalid @enderror form-control" type="password" name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </label>
            </div>

            <div class="mb-3">
                <label class="form-check-label">
                    <input type="checkbox" name="remember" class="form-check-input">
                    Remember me
                </label>
            </div>

            <input type="submit" value="Register" class="btn btn-primary">

            <code>{{ $errors }}</code>
        </form>
    </div>
@endsection
