{{-- resources/views/admin/schedules/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="movie-page">

    {{-- Header halaman --}}
    <div class="admin-page-header mb-4">
        <div class="admin-breadcrumb text-muted mb-1">
            Admin • Jadwal
        </div>
        <h1 class="page-title mb-0">
            Tambah Jadwal Film
        </h1>
    </div>

    {{-- Kartu form --}}
    <div class="card admin-form-card">
        <form action="{{ route('admin.schedules.store') }}" method="POST">
            @csrf

            {{-- FILM --}}
            <div class="mb-3">
                <label for="movie_id" class="form-label">Film</label>
                <select name="movie_id" id="movie_id"
                        class="form-select @error('movie_id') is-invalid @enderror">
                    <option value="" disabled selected>-- Pilih Film --</option>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
                @error('movie_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- STUDIO --}}
            <div class="mb-3">
                <label for="studio_id" class="form-label">Studio</label>
                <select name="studio_id" id="studio_id"
                        class="form-select @error('studio_id') is-invalid @enderror">
                    <option value="" disabled selected>-- Pilih Studio --</option>
                    @foreach($studios as $studio)
                        <option value="{{ $studio->id }}" {{ old('studio_id') == $studio->id ? 'selected' : '' }}>
                            {{ $studio->name }} - {{ $studio->cinema->name }}
                        </option>
                    @endforeach
                </select>
                @error('studio_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- WAKTU MULAI --}}
            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <div class="position-relative">
                    <input
                        type="datetime-local"
                        name="start_time"
                        id="start_time"
                        value="{{ old('start_time') }}"
                        class="form-control @error('start_time') is-invalid @enderror">
                    <span class="datetime-icon">
                        <i class="bi bi-calendar-event"></i>
                    </span>
                </div>
                @error('start_time')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- WAKTU SELESAI --}}
            <div class="mb-4">
                <label for="end_time" class="form-label">Waktu Selesai</label>
                <div class="position-relative">
                    <input
                        type="datetime-local"
                        name="end_time"
                        id="end_time"
                        value="{{ old('end_time') }}"
                        class="form-control @error('end_time') is-invalid @enderror">
                    <span class="datetime-icon">
                        <i class="bi bi-calendar-event"></i>
                    </span>
                </div>
                @error('end_time')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-outline-light booking-btn-ghost">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary booking-btn-primary">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
