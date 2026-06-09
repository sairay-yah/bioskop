@extends('layouts.app')

@section('content')
<div class="admin-breadcrumb mb-2">
    Admin · <span>Booking</span>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Kelola Booking</h1>
</div>

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th style="width: 110px;">Tanggal</th>
            <th>Film</th>
            <th style="width: 200px;">Bioskop / Studio</th>
            <th style="width: 160px;">User</th>
            <th style="width: 160px;">Kursi</th>
            <th style="width: 140px;">Total</th>
            <th style="width: 120px;">Status</th>
            <th style="width: 180px;" class="text-end">Aksi</th>
        </tr>
        </thead>

        <tbody>
        @forelse($bookings as $index => $booking)
            @php
                $schedule = $booking->schedule;
                $movie    = $schedule?->movie;
                $studio   = $schedule?->studio;
                $cinema   = $studio?->cinema;
            @endphp

            <tr>
                <td class="text-muted">{{ $bookings->firstItem() + $index }}</td>

                <td>
                    {{ optional($schedule?->start_time)->format('d-m-Y') }}<br>
                    <small class="text-muted">
                        {{ optional($schedule?->start_time)->format('H:i') }} WIB
                    </small>
                </td>

                <td class="fw-semibold">
                    {{ $movie?->title ?? '-' }}
                </td>

                <td>
                    {{ $cinema?->name ?? '-' }}<br>
                    <small class="text-muted">
                        {{ $studio?->name ?? '' }}
                    </small>
                </td>

                <td>
                    {{ $booking->user?->name ?? '-' }}<br>
                    <small class="text-muted">
                        {{ $booking->user?->email ?? '' }}
                    </small>
                </td>

                <td>
                    {{ $booking->tickets->pluck('seat.seat_code')->join(', ') ?: '-' }}
                </td>

                <td>
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </td>

                {{-- STATUS --}}
                <td>
                    @if($booking->status === 'paid')
                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">
                            Lunas
                        </span>
                    @else
                        <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill">
                            Pending
                        </span>
                    @endif
                </td>

                {{-- AKSI (ADMIN NONAKTIF) --}}
                <td class="text-end">
                    @if($booking->status === 'paid')
                        <button class="btn btn-sm btn-outline-light px-3" disabled>
                            Sudah Lunas
                        </button>
                    @else
                        {{-- Admin tidak mengubah status lagi --}}
                        <span class="badge bg-secondary-subtle text-light px-3 py-2 rounded-pill"
                              style="opacity:.85;">
                            Menunggu user bayar
                        </span>
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

<div class="mt-3">
    {{ $bookings->links() }}
</div>
@endsection
