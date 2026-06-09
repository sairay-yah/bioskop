{{-- resources/views/tickets/show.blade.php --}}
@extends('layouts.app')

@section('content')
@php
    $booking  = $ticket->booking;
    $schedule = $booking->schedule;
    $movie    = $schedule->movie;
    $studio   = $schedule->studio;
    $cinema   = $studio->cinema;

    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : \Carbon\Carbon::parse($schedule->start_time);

    $seats = $booking->tickets
        ->map(fn($t) => optional($t->seat)->seat_code)
        ->filter()
        ->implode(', ');
@endphp

<div class="page-wrap">
    {{-- HEAD --}}
    <div class="page-head">
        <div>
            <div class="page-kicker">E-TICKET</div>
            <h1 class="page-title">{{ $movie->title }}</h1>
            <div class="page-subtitle">
                Tunjukkan QR ini saat masuk studio. Jangan dishare sembarangan 😼
            </div>
        </div>

        <div class="chip chip-success">AKTIF</div>
    </div>

    {{-- CARD --}}
    <div class="glass-card ticket-card">
        <div class="ticket-grid">

            {{-- LEFT --}}
            <div class="ticket-left">

                <div class="ticket-block">
                    <div class="ticket-label">Kode Booking</div>
                    <div class="ticket-value mono">{{ $booking->booking_code }}</div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Kode Tiket (QR)</div>
                    <div class="ticket-value mono">{{ $ticket->ticket_code }}</div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Kursi</div>
                    <div class="ticket-value">{{ $seats ?: '-' }}</div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Jadwal</div>
                    <div class="ticket-value">{{ $start->format('d-m-Y H:i') }} WIB</div>
                </div>

                <div class="ticket-block">
                    <div class="ticket-label">Bioskop</div>
                    <div class="ticket-value">
                        {{ $cinema->name }} ({{ $studio->name }})
                        <div class="ticket-sub">{{ $cinema->address }}</div>
                    </div>
                </div>

                <div class="divider-soft"></div>

                <div class="ticket-actions">
                    <a href="{{ route('home') }}" class="btn-pill btn-pill-primary">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('bookings.history') }}" class="btn-pill btn-pill-muted">
                        Riwayat Pesanan
                    </a>
                </div>
            </div>

            {{-- RIGHT (QR) --}}
            <div class="ticket-qr-wrapper">
                <div class="ticket-qr-card">
                    <div class="ticket-qr-title">SCAN QR</div>
                    <div class="ticket-qr-subtitle">Valid untuk 1x masuk</div>

                    {{-- QR (simulasi) --}}
                    <img
                        src="{{ asset('images/QRIS.jpg') }}"
                        alt="QR Code"
                        class="ticket-qr-image"
                    >

                    <div class="ticket-qr-note">
                        Datang minimal <strong>15 menit</strong> sebelum jadwal 🎬
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
