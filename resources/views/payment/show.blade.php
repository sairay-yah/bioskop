@extends('layouts.app')

@section('content')
@php
    $schedule = $booking->schedule;
    $movie    = $schedule->movie;
    $studio   = $schedule->studio;
    $cinema   = $studio->cinema;

    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : \Carbon\Carbon::parse($schedule->start_time);

    $firstTicket = $booking->tickets->first();
@endphp

<div class="page-wrap">
    <div class="page-head">
        <div>
            <div class="page-kicker">PEMBAYARAN</div>
            <h1 class="page-title">Booking <span class="text-glow">{{ $booking->booking_code }}</span></h1>
            <div class="page-subtitle">
                Scan QRIS untuk bayar (simulasi). Setelah itu klik <b>Refresh</b> untuk masuk ke E-Ticket.
            </div>
        </div>
    </div>

    <div class="glass-card payment-card">
        <div class="payment-grid">
            {{-- LEFT: detail --}}
            <div class="payment-left">
                <div class="section-title">Detail Pesanan</div>

                <div class="info-list">
                    <div class="info-row">
                        <div class="info-label">Film</div>
                        <div class="info-value">{{ $movie->title }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jadwal</div>
                        <div class="info-value">{{ $start->format('d-m-Y H:i') }} WIB</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Bioskop</div>
                        <div class="info-value">
                            {{ $cinema->name }} ({{ $studio->name }})
                            <div class="info-sub">{{ $cinema->address }}</div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Jumlah Kursi</div>
                        <div class="info-value">{{ $booking->seat_count }}</div>
                    </div>

                    <div class="info-row total-row">
                        <div class="info-label">Total</div>
                        <div class="info-value price">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="hint-box">
                    <div class="hint-title">Tips</div>
                    <div class="hint-text">
                        Kalau E-Ticket belum kebuka setelah klik Refresh,
                        berarti status booking kamu masih <b>pending</b> (belum dianggap paid di sistem).
                    </div>
                </div>
            </div>

            {{-- RIGHT: QR + action --}}
            <div class="payment-right">
                <div class="section-title text-center">QRIS</div>

                <div class="qr-wrap">
                    <img src="{{ asset('images/QRIS.jpg') }}" alt="QRIS" class="qr-image">
                </div>

            <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap">

            {{-- ✅ Refresh ke E-Ticket (langsung paid) --}}
                <form action="{{ route('payment.refresh', $booking->id) }}" method="POST">
                @csrf
                    <button type="submit" class="btn btn-success px-4 btn-aksi">
                        Refresh (Ke E-Ticket)
                        </button>
                    </form>

                {{-- Riwayat --}}
                    <a href="{{ route('bookings.history') }}" class="btn btn-primary px-4 btn-aksi">
                    Riwayat Pesanan
                </a>

                </div>


                <div class="mini-note text-center">
                    Dengan klik refresh, kamu “cek ulang” status booking kamu. Kalau sudah paid, tiket langsung tampil.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
