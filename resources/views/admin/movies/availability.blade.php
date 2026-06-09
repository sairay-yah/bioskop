@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="admin-breadcrumb mb-2">
    Admin · <span>Filter Jadwal</span>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div>
        <h1 class="page-title mb-1">Filter Jadwal per Hari</h1>
        <div class="text-muted small">
            Pilih tanggal untuk melihat jadwal + jumlah kursi tersedia.
        </div>
    </div>

    <form method="GET" action="{{ route('admin.schedules.availability') }}" class="d-flex gap-2 align-items-center">
        <input type="date" name="date" value="{{ $date }}" class="form-control" style="max-width: 190px;">
        <button class="btn btn-primary btn-pill px-4" type="submit">Filter</button>
    </form>
</div>

<div class="card-glass p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-borderless align-middle mb-0 admin-table">
            <thead class="table-head">
            <tr>
                <th style="width:110px;">Jam</th>
                <th>Film</th>
                <th style="width:220px;">Bioskop / Studio</th>
                <th style="width:120px;">Total</th>
                <th style="width:120px;">Booked</th>
                <th style="width:120px;">Tersedia</th>
                <th style="width:160px;" class="text-end">Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse($schedules as $schedule)
                @php
                    $totalSeats = $schedule->studio?->seats?->count() ?? 0;
                    $bookedIds  = $bookedSeatIdsBySchedule->get($schedule->id, collect());
                    $bookedCount = $bookedIds->count();
                    $availableCount = max(0, $totalSeats - $bookedCount);
                    $start = Carbon::parse($schedule->start_time);
                @endphp

                <tr class="table-row">
                    <td>
                        <div class="fw-semibold">{{ $start->format('H:i') }}</div>
                        <div class="small text-muted">{{ $start->format('d-m-Y') }}</div>
                    </td>

                    <td class="fw-semibold">
                        {{ $schedule->movie->title ?? '-' }}
                    </td>

                    <td>
                        <div>{{ $schedule->studio?->cinema?->name ?? '-' }}</div>
                        <div class="small text-muted">{{ $schedule->studio?->name ?? '-' }}</div>
                    </td>

                    <td>{{ $totalSeats }}</td>
                    <td>{{ $bookedCount }}</td>

                    <td class="fw-semibold">
                        <span class="{{ $availableCount > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $availableCount }}
                        </span>
                    </td>

                    <td class="text-end">
                        <a href="{{ route('admin.schedules.availability.detail', $schedule) }}"
                           class="btn btn-sm btn-outline-light btn-pill px-3">
                            Lihat Kursi
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        Tidak ada jadwal di tanggal ini.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
