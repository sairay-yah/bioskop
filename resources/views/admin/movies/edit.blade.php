@extends('layouts.app')

@section('content')
<div class="admin-breadcrumb mb-2">
    Admin · <span>Film</span>
</div>

<h1 class="page-title mb-3">Edit Film</h1>

<div class="card admin-card-form p-4 p-md-5">
    <form action="{{ route('admin.movies.update', $movie) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Kolom kiri: form input --}}
            <div class="col-lg-7">
                <div class="mb-3">
                    <label class="form-label" for="title">Judul Film</label>
                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $movie->title) }}"
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Deskripsi / Sinopsis</label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              required>{{ old('description', $movie->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="duration">Durasi (menit)</label>
                        <input type="number"
                               id="duration"
                               name="duration"
                               class="form-control @error('duration') is-invalid @enderror"
                               value="{{ old('duration', $movie->duration) }}"
                               required>
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="genre">Genre</label>
                        <input type="text"
                               id="genre"
                               name="genre"
                               class="form-control @error('genre') is-invalid @enderror"
                               value="{{ old('genre', $movie->genre) }}"
                               required>
                        @error('genre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="age_rating">Rating Umur</label>
                        <input type="text"
                               id="age_rating"
                               name="age_rating"
                               class="form-control @error('age_rating') is-invalid @enderror"
                               value="{{ old('age_rating', $movie->age_rating) }}"
                               placeholder="SU, 13+, 17+"
                               required>
                        @error('age_rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label" for="base_price">Harga Dasar Tiket</label>
                    <input type="number"
                           id="base_price"
                           name="base_price"
                           class="form-control @error('base_price') is-invalid @enderror"
                           value="{{ old('base_price', $movie->base_price) }}"
                           required>
                    @error('base_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text-small mt-1">
                        Masukkan harga dalam rupiah tanpa titik/koma, misal: <strong>35000</strong>.
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: poster --}}
            <div class="col-lg-5">
                <div class="mb-3">
                    <label class="form-label" for="poster">Poster Film</label>
                    <input type="file"
                           id="poster"
                           name="poster"
                           class="form-control @error('poster') is-invalid @enderror"
                           accept="image/*">
                    @error('poster')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text-small mt-1">
                        Biarkan kosong jika tidak ingin mengganti poster.
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-label">Poster Saat Ini</div>
                    @if($movie->poster)
                        <div class="admin-poster-wrapper">
                            <img src="{{ asset('storage/' . $movie->poster) }}"
                                 alt="Poster {{ $movie->title }}"
                                 class="admin-poster-img">
                        </div>
                    @else
                        <div class="admin-poster-placeholder">
                            Tidak ada poster
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.movies.index') }}"
               class="btn btn-outline-light px-4">
                Kembali
            </a>

            <button type="submit" class="btn btn-primary px-5">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
