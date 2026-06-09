@extends('layouts.app')

@section('content')
<div class="container px-0">

    {{-- Breadcrumb kecil --}}
    <div class="mb-2 text-muted small">
        <p class="admin-subtitle">Admin · Jadwal</p>
    </div>

    {{-- Judul & tombol tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="page-title mb-0">Kelola Jadwal Film</h1>

        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
            + Tambah Jadwal
        </a>
    </div>

    {{-- Kartu tabel jadwal --}}
    <div class="card card-admin-table">
        <div class="table-responsive">
            <table class="table table-borderless align-middle admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width: 4%">#</th>
                        <th>Film</th>
                        <th style="width: 26%">Tanggal &amp; Jam</th>
                        <th style="width: 15%">Studio</th>
                        <th style="width: 25%">Bioskop</th>
                        <th style="width: 14%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                        @php
                            $movie  = $schedule->movie;
                            $studio = $schedule->studio;
                            $cinema = $studio?->cinema;

                            $start = $schedule->start_time instanceof \Carbon\Carbon
                                ? $schedule->start_time
                                : \Carbon\Carbon::parse($schedule->start_time);

                            $end = $schedule->end_time instanceof \Carbon\Carbon
                                ? $schedule->end_time
                                : \Carbon\Carbon::parse($schedule->end_time);
                        @endphp

                        <tr>
                            {{-- No --}}
                            <td class="text-muted small">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Judul film --}}
                            <td>
                                <div class="fw-semibold">
                                    {{ $movie->title }}
                                </div>
                            </td>

                            {{-- Tanggal & Jam --}}
                            <td>
                                <div class="schedule-time-main">
                                    {{ $start->format('d-m-Y') }}
                                </div>
                                <div class="schedule-time-sub">
                                    {{ $start->format('H:i') }} - {{ $end->format('H:i') }} WIB
                                </div>
                            </td>

                            {{-- Studio --}}
                            <td>
                                <div class="schedule-studio">
                                    {{ $studio?->name ?? '-' }}
                                </div>
                            </td>

                            {{-- Bioskop --}}
                            <td>
                                <div class="schedule-cinema-name">
                                    {{ $cinema?->name ?? '-' }}
                                </div>
                                @if($cinema?->address)
                                    <div class="schedule-cinema-address">
                                        {{ $cinema->address }}
                                    </div>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.schedules.edit', $schedule) }}"
                                       class="btn btn-sm btn-warning px-3 rounded-pill">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.schedules.destroy', $schedule) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger px-3 rounded-pill">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada jadwal film yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
