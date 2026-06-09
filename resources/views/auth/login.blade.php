@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="card auth-card card-compact">
        <h1 class="auth-title text-center">Masuk</h1>
        <p class="auth-subtitle text-center">
            Silakan login untuk memesan tiket bioskop.
        </p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- USERNAME --}}
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username"
                       type="text"
                       name="username"
                       value="{{ old('username') }}"
                       required
                       autofocus
                       class="form-control @error('username') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- REMEMBER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox"
                           name="remember"
                           id="remember"
                           class="form-check-input"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-check-label">
                        Remember Me
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                Login
            </button>

            <div class="text-center">
                <span class="form-text-small">
                    Belum punya akun?
                </span>
                <a href="{{ route('register') }}" class="btn-link-soft">
                    Daftar sekarang
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
