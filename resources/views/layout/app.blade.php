<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
<div class="wrapper">
    @section('header')
        <div class="container">
            <header class="d-flex justify-content-center py-3">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a @class([
                                'nav-link',
                                'active' => request()->routeIs('home'),
                            ]) href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Posts</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a @class([
                                    'nav-link',
                                    'active' => request()->routeIs('user.login.form'),
                                ]) href="{{ route('user.login.form') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a @class([
                                    'nav-link',
                                    'active' => request()->routeIs('user.register.form'),
                                ]) href="{{ route('user.register.form') }}" class="nav-link">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a @class([
                                    'nav-link',
                                    'active' => request()->routeIs('user.profile'),
                                ]) href="{{ route('user.profile') }}" class="nav-link">Profile</a>
                        </li>
                    @endguest
                </ul>
            </header>
        </div>
    @show
    @yield('main')
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
