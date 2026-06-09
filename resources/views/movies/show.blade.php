@extends('layouts.app')

@section('content')
<div class="movie-page container-xxl">

    {{-- HERO FILM --}}
    <div class="movie-hero">
        {{-- Poster --}}
        <div class="movie-hero-poster">
            @if($movie->poster)
                <img src="{{ asset('storage/'.$movie->poster) }}"
                     alt="{{ $movie->title }}"
                     class="movie-poster-img">
            @else
                <div class="movie-poster-placeholder">
                    <span>{{ substr($movie->title, 0, 1) }}</span>
                </div>
            @endif
        </div>

        {{-- Info Film --}}
        <div class="movie-hero-info">

            {{-- JUDUL (lebih besar) --}}
            <h1 class="movie-title-main">
                {{ $movie->title }}
            </h1>

            {{-- DESKRIPSI (lebih kebaca) --}}
            <p class="movie-description-main">
                {{ $movie->description }}
            </p>

            {{-- META --}}
            <div class="movie-meta-grid">
                <div class="movie-meta-item">
                    <span class="meta-label">Durasi</span>
                    <span class="meta-value">{{ $movie->duration }} menit</span>
                </div>

                <div class="movie-meta-item">
                    <span class="meta-label">Genre</span>
                    <span class="meta-pill">{{ $movie->genre }}</span>
                </div>

                <div class="movie-meta-item">
                    <span class="meta-label">Rating Umur</span>
                    <span class="meta-pill pill-age">{{ $movie->age_rating }}</span>
                </div>

                <div class="movie-meta-item">
                    <span class="meta-label">Harga Dasar</span>
                    <span class="meta-price">
                        Rp {{ number_format($movie->base_price, 0, ',', '.') }}
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- JADWAL TAYANG --}}
    <div class="movie-schedule card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center movie-schedule-header">
            <div>
                <h2 class="movie-schedule-title mb-0">Jadwal Tayang</h2>
                <p class="movie-schedule-subtitle mb-0">
                    Pilih jadwal yang kamu mau, lalu lanjutkan ke pemilihan kursi.
                </p>
            </div>
        </div>

        <div class="table-responsive movie-schedule-table">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="col-3">Tanggal &amp; Jam</th>
                        <th class="col-2">Studio</th>
                        <th class="col-5">Bioskop</th>
                        <th class="col-2 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($schedules as $schedule)
                    @php
                        $start = $schedule->start_time instanceof \Carbon\Carbon
                            ? $schedule->start_time
                            : \Carbon\Carbon::parse($schedule->start_time);
                    @endphp

                    <tr>
                        <td>
                            <div class="schedule-time-main">
                                {{ $start->format('d M Y') }}
                            </div>
                            <div class="schedule-time-sub">
                                {{ $start->format('H:i') }} WIB
                            </div>
                        </td>

                        <td>
                            <span class="schedule-studio">
                                {{ $schedule->studio->name }}
                            </span>
                        </td>

                        <td>
                            <div class="schedule-cinema-name">
                                {{ $schedule->studio->cinema->name }}
                            </div>
                            <div class="schedule-cinema-address">
                                {{ $schedule->studio->cinema->address }}
                            </div>
                        </td>

                        <td class="text-center">
                            @auth
                                @if(auth()->user()->role === 'pelanggan')
                                    <a href="{{ route('booking.seats', ['schedule' => $schedule->id]) }}"
                                       class="btn btn-success btn-sm schedule-cta">
                                        Pilih Kursi
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Login sebagai pelanggan</span>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm schedule-cta">
                                    Login untuk pesan
                                </a>
                            @endauth
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada jadwal tayang untuk film ini.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
