{{-- resources/views/bookings/history.blade.php --}}
@extends('layouts.app')

@section('content')
<h1 class="page-title mb-3">Riwayat Pesanan</h1>

@if($bookings->isEmpty())
    <div class="card-glass p-4">
        <p class="mb-1 fw-semibold">Belum ada pesanan</p>
        <p class="mb-0 text-muted">
            Yuk pilih film di halaman utama lalu pesan tiketmu 🎬
        </p>
    </div>
@else
    <div class="admin-table-wrapper card card-table p-0">
        <table class="table table-borderless align-middle mb-0 admin-table">
            <thead>
            <tr>
                <th style="width: 120px;">Tanggal</th>
                <th>Film</th>
                <th style="width: 260px;">Bioskop</th>
                <th style="width: 170px;">Kursi</th>
                <th style="width: 140px;">Total</th>
                <th style="width: 120px;">Status</th>
                <th style="width: 150px;" class="text-end">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                @php
                    $schedule = $booking->schedule;
                    $movie    = $schedule->movie;
                    $studio   = $schedule->studio;
                    $cinema   = $studio->cinema;

                    $start = $schedule->start_time instanceof \Carbon\Carbon
                        ? $schedule->start_time
                        : \Carbon\Carbon::parse($schedule->start_time);

                    $seats = $booking->tickets
                        ->map(fn($ticket) => optional($ticket->seat)->seat_code)
                        ->filter()
                        ->implode(', ');

                    $status      = $booking->status ?? 'pending';
                    $firstTicket = $booking->tickets->first();
                @endphp

                <tr>
                    <td>
                        <div class="schedule-time-main">{{ $start->format('d-m-Y') }}</div>
                        <div class="schedule-time-sub">{{ $start->format('H:i') }} WIB</div>
                    </td>

                    <td class="fw-semibold">{{ $movie->title }}</td>

                    <td>
                        <div class="schedule-cinema-name">{{ $cinema->name }}</div>
                        <div class="schedule-cinema-address">{{ $studio->name }} · {{ $cinema->address }}</div>
                    </td>

                    <td>{{ $seats ?: '-' }}</td>

                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>

                    <td>
                        @if($status === 'paid' || $status === 'lunas')
                            <span class="badge bg-success rounded-pill px-3">Lunas</span>
                        @elseif($status === 'pending')
                            <span class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                        @else
                            <span class="badge bg-secondary rounded-pill px-3">{{ ucfirst($status) }}</span>
                        @endif
                    </td>

                    <td class="text-end aksi-col">
                        @if($status === 'paid' || $status === 'lunas')
                            @if($firstTicket)
                                <a href="{{ route('tickets.show', ['ticket' => $firstTicket->id, 'from' => 'history']) }}"
                                   class="btn btn-sm btn-primary btn-aksi">
                                    Lihat E-Ticket
                                </a>
                            @else
                                <span class="text-muted small">Tiket belum tersedia</span>
                            @endif

                        @elseif($status === 'pending')
                            <a href="{{ route('payment.show', ['booking' => $booking->id, 'from' => 'history']) }}"
                               class="btn btn-sm btn-success btn-aksi">
                                Bayar
                            </a>

                        @else
                            <span class="text-muted small">Tidak tersedia</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
