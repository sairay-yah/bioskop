@extends('layouts.app')

@section('content')
<div class="container px-0">

    {{-- Breadcrumb kecil --}}
    <div class="mb-2 text-muted small">
        Admin · Jadwal
    </div>

    {{-- Judul halaman --}}
    <h1 class="page-title mb-3">
        Edit Jadwal Film
    </h1>

    {{-- Kartu form --}}
    <div class="card card-admin-form">
        <div class="card-body">
            <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')

                @php
                    $startValue = $schedule->start_time instanceof \Carbon\Carbon
                        ? $schedule->start_time->format('Y-m-d\TH:i')
                        : \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i');

                    $endValue = $schedule->end_time instanceof \Carbon\Carbon
                        ? $schedule->end_time->format('Y-m-d\TH:i')
                        : \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d\TH:i');
                @endphp

                {{-- Film --}}
                <div class="mb-3">
                    <label class="form-label" for="movie_id">Film</label>
                    <select name="movie_id" id="movie_id" class="form-control">
                        @foreach($movies as $movie)
                            <option value="{{ $movie->id }}"
                                {{ old('movie_id', $schedule->movie_id) == $movie->id ? 'selected' : '' }}>
                                {{ $movie->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('movie_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Studio --}}
                <div class="mb-3">
                    <label class="form-label" for="studio_id">Studio</label>
                    <select name="studio_id" id="studio_id" class="form-control">
                        @foreach($studios as $studio)
                            <option value="{{ $studio->id }}"
                                {{ old('studio_id', $schedule->studio_id) == $studio->id ? 'selected' : '' }}>
                                {{ $studio->name }} - {{ $studio->cinema->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('studio_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Waktu Mulai --}}
                <div class="mb-3">
                    <label class="form-label" for="start_time">Waktu Mulai</label>
                    <input
                        type="datetime-local"
                        name="start_time"
                        id="start_time"
                        class="form-control"
                        value="{{ old('start_time', $startValue) }}"
                    >
                    @error('start_time')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Waktu Selesai --}}
                <div class="mb-4">
                    <label class="form-label" for="end_time">Waktu Selesai</label>
                    <input
                        type="datetime-local"
                        name="end_time"
                        id="end_time"
                        class="form-control"
                        value="{{ old('end_time', $endValue) }}"
                    >
                    @error('end_time')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol aksi --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-light">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
