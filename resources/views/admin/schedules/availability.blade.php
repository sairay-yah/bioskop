@extends('layouts.app')

@section('content')
<div class="admin-breadcrumb mb-2">
    Admin · <span>Filter Jadwal</span>
</div>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <h1 class="page-title mb-0">Filter Jadwal per Hari</h1>

    <form method="GET" action="{{ route('admin.schedules.availability') }}" class="d-flex gap-2 align-items-center">
        <input type="date" name="date" value="{{ $date }}" class="form-control" style="max-width: 190px;">
        <button class="btn btn-primary btn-pill" type="submit">Filter</button>
    </form>
</div>

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width:110px;">Jam</th>
            <th>Film</th>
            <th style="width:220px;">Bioskop / Studio</th>
            <th style="width:120px;">Total Kursi</th>
            <th style="width:120px;">Terbooking</th>
            <th style="width:120px;">Tersedia</th>
            <th style="width:160px;" class="text-end">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($schedules as $schedule)
            @php
                $totalSeats = $schedule->studio->seats->count();
                $bookedIds  = $bookedSeatIdsBySchedule->get($schedule->id, collect());
                $bookedCount = $bookedIds->count();
                $availableCount = max(0, $totalSeats - $bookedCount);
            @endphp

            <tr>
                <td>
                    <div class="fw-semibold">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</div>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($schedule->start_time)->format('d-m-Y') }}</small>
                </td>

                <td class="fw-semibold">{{ $schedule->movie->title }}</td>

                <td>
                    {{ $schedule->studio->cinema->name }} <br>
                    <small class="text-muted">{{ $schedule->studio->name }}</small>
                </td>

                <td>{{ $totalSeats }}</td>
                <td>{{ $bookedCount }}</td>
                <td class="fw-semibold">{{ $availableCount }}</td>

                <td class="text-end">
                    <a href="{{ route('admin.schedules.availability.detail', ['schedule' => $schedule->id]) }}"
                     class="btn btn-sm btn-outline-light btn-pill px-3">
                      Lihat Kursi
                    </a>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    Tidak ada jadwal di tanggal ini.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
