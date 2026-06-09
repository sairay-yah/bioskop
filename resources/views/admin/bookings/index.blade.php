@extends('layouts.app')

@section('content')
<div class="admin-breadcrumb mb-2">
    Admin · <span>Pesanan</span>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Kelola Pesanan</h1>
</div>

@if(session('success'))
    <div class="alert alert-success mb-3">
        {{ session('success') }}
    </div>
@endif

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th style="width: 110px;">Tanggal</th>
            <th>Film</th>
            <th style="width: 220px;">Bioskop / Studio</th>
            <th style="width: 180px;">User</th>
            <th style="width: 160px;">Kursi</th>
            <th style="width: 140px;">Total</th>
            <th style="width: 120px;">Status</th>
            <th style="width: 160px;" class="text-end">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($bookings as $index => $booking)
            @php
                $schedule    = $booking->schedule;
                $movie       = $schedule?->movie;
                $studio      = $schedule?->studio;
                $cinema      = $studio?->cinema;
                $start       = $schedule?->start_time;
                $firstTicket = $booking->tickets->first();
            @endphp

            <tr>
                <td class="text-muted">{{ $bookings->firstItem() + $index }}</td>

                <td>
                    @if($start)
                        {{ \Carbon\Carbon::parse($start)->format('d-m-Y') }}<br>
                        <small class="schedule-time-sub">
                            {{ \Carbon\Carbon::parse($start)->format('H:i') }} WIB
                        </small>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                <td class="fw-semibold">
                    {{ $movie?->title ?? '-' }}
                </td>

                <td>
                    {{ $cinema?->name ?? '-' }}<br>
                    <small class="schedule-cinema-address">
                        {{ $studio?->name ?? '' }}
                    </small>
                </td>

                <td>
                    {{ $booking->user?->name ?? '-' }}<br>
                    <small class="schedule-time-sub">
                        {{ $booking->user?->email ?? '' }}
                    </small>
                </td>

                <td>
                    {{ $booking->tickets->pluck('seat.seat_code')->filter()->join(', ') ?: '-' }}
                </td>

                <td>
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </td>

                <td>
                    @if($booking->status === 'paid')
                        <span class="badge rounded-pill px-3 py-1"
                              style="background: rgba(34,197,94,0.18); color:#4ade80;">
                            Lunas
                        </span>
                    @else
                        <span class="badge rounded-pill px-3 py-1"
                              style="background: rgba(250,204,21,0.18); color:#facc15;">
                            Pending
                        </span>
                    @endif
                </td>

                <td class="text-end">
                    @if($booking->status !== 'paid')
                        <form action="{{ route('admin.bookings.mark-paid', $booking) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Konfirmasi pembayaran booking ini sebagai LUNAS?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success px-3">
                                Konfirmasi Lunas
                            </button>
                        </form>
                    @else
                        <button class="btn btn-sm btn-outline-light px-3" disabled>
                            Sudah Lunas
                        </button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted py-4">
                    Belum ada booking.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if($bookings->hasPages())
    <div class="mt-3 d-flex justify-content-end">
        {{ $bookings->onEachSide(1)->links() }}
    </div>
@endif
@endsection
