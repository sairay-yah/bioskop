<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bioskop Laravel</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    {{-- CSS custom --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TriVerse Cinema's</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            {{-- Kiri --}}
            <ul class="navbar-nav me-auto">
                @auth
                    @if(auth()->user()->role === 'admin')

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.movies.*') ? 'active' : '' }}"
                               href="{{ route('admin.movies.index') }}">
                                Film
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.schedules.*') && !request()->routeIs('admin.schedules.availability*') ? 'active' : '' }}"
                               href="{{ route('admin.schedules.index') }}">
                                Jadwal
                            </a>
                        </li>

                        {{-- ✅ FILTER JADWAL (CUMA SATU) --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.schedules.availability*') ? 'active' : '' }}"
                               href="{{ route('admin.schedules.availability') }}">
                                Filter Jadwal
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
                               href="{{ route('admin.bookings.index') }}">
                                Pesanan
                            </a>
                        </li>

                    @elseif(auth()->user()->role === 'pelanggan')

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('bookings.history') ? 'active' : '' }}"
                               href="{{ route('bookings.history') }}">
                                Riwayat
                            </a>
                        </li>

                    @endif
                @endauth
            </ul>

            {{-- Kanan --}}
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item me-2">
                        <span class="navbar-user">{{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-light rounded-pill px-3" type="submit">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item me-1">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<main class="app-shell">
    <div class="container">
        {{-- Flash message --}}
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mb-3">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</main>

<footer class="app-footer">
    &copy; {{ date('Y') }} Bioskop Laravel. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
