@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="card auth-card card-compact">
        <h1 class="auth-title text-center">Registrasi</h1>
        <p class="auth-subtitle text-center">
            Buat akun baru untuk mulai memesan tiket bioskop.
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NAMA --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name"
                       type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       autofocus
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- USERNAME --}}
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username"
                       type="text"
                       name="username"
                       value="{{ old('username') }}"
                       required
                       class="form-control @error('username') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')
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

            {{-- KONFIRMASI PASSWORD --}}
            <div class="mb-4">
                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                <input id="password-confirm"
                       type="password"
                       name="password_confirmation"
                       required
                       class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                Register
            </button>

            <div class="text-center">
                <span class="form-text-small">
                    Sudah punya akun?
                </span>
                <a href="{{ route('login') }}" class="btn-link-soft">
                    Login di sini
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
