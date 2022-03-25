@extends('layout.app')

@section('main')
    <div class="container mb-5">
        <div class="d-flex align-items-center justify-content-between gap-3">
            <h1 class="mb-0">{{ auth()->user()->name }}</h1>
            <a class="btn btn-outline-danger" href="{{ route('user.logout') }}">Logout</a>
        </div>
        <p class="lead">{{ auth()->user()->email }}</p>
    </div>
    @isset(request()->new_token)
        <section class="container mb-5 alert alert-warning">
            <h2>Your new token</h2>
            <p class="lead">
                Remember it because you will never see it again
            </p>
            <code class="user-select-all d-block mb-3">{{ request()->new_token }}</code>
            <a href="{{ route('user.profile') }}" class="w-100 btn btn-primary">
                I remember
            </a>
        </section>
    @endisset
    <section class="container mb-5">
        <h2>My posts</h2>
        <ul class="list-group">
            @forelse($authored as $post)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center fw-bold">
                        <a href="#">{{ $post->title }}</a>
                        <span class="badge bg-danger rounded-pill">❤ {{ $post->likes_count }}</span>
                    </div>
                    <div>
                        {{ Str::limit($post->content) }}
                    </div>
                </li>
            @empty
                <li class="list-group-item">
                    No posts
                </li>
            @endforelse
        </ul>
    </section>
    <section class="container pb-3">
        <h2>Tokens</h2>
        <ul class="list-group">
            @foreach($tokens as $token)
                <li class="list-group-item">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-primary rounded-pill fs-6">{{ $token->name }}</span>
                        <code>{{ $token->token }}</code>
                        <form class="ms-auto" action="{{ route('token.revoke') }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="token" value="{{ $token->token }}">
                            <input class="btn btn-outline-warning" type="submit" value="Revoke">
                        </form>
                    </div>
                    <div class="d-block invalid-feedback">
                        {{ $errors->revoke->first('token') }}
                    </div>
                </li>
            @endforeach
            <li class="list-group-item">
                <form class="d-flex flex-column gap-2" action="{{ route('token.issue') }}" method="post">
                    @csrf
                    <label>
                        Token name:
                        <input class="form-control @error('name', 'issue') is-invalid @enderror" type="text" name="name"
                               placeholder="Ivan's phone">
                        @error('name', 'issue')
                        <div class="invalid-feedback">
                            {{ $errors->issue->first('name') }}
                        </div>
                        @enderror
                    </label>
                    <input class="btn btn-primary" type="submit" value="Issue new token">
                </form>
            </li>
        </ul>
    </section>
@endsection
