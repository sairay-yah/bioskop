@extends('layouts.app')

@section('content')
{{-- HEADER --}}
<div class="page-header">
    <div>
        <div class="page-subtitle">Admin · Film</div>
        <h1 class="page-title">Tambah Film</h1>
    </div>
</div>

{{-- CARD FORM --}}
<div class="admin-card">
    <div class="card-body admin-form">
        <form action="{{ route('admin.movies.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label" for="title">Judul Film</label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Deskripsi / Sinopsis</label>
                        <textarea name="description" id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="duration">Durasi (menit)</label>
                            <input type="number" name="duration" id="duration"
                                   value="{{ old('duration') }}"
                                   class="form-control @error('duration') is-invalid @enderror"
                                   required>
                            @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="genre">Genre</label>
                            <input type="text" name="genre" id="genre"
                                   value="{{ old('genre') }}"
                                   class="form-control @error('genre') is-invalid @enderror"
                                   required>
                            @error('genre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="age_rating">Rating Umur</label>
                            <input type="text" name="age_rating" id="age_rating"
                                   placeholder="Contoh: SU, R13+"
                                   value="{{ old('age_rating') }}"
                                   class="form-control @error('age_rating') is-invalid @enderror"
                                   required>
                            @error('age_rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label" for="base_price">Harga Dasar Tiket</label>
                        <input type="number" name="base_price" id="base_price"
                               value="{{ old('base_price') }}"
                               class="form-control @error('base_price') is-invalid @enderror"
                               required>
                        @error('base_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="poster">Poster Film (opsional)</label>
                    <input type="file" name="poster" id="poster"
                           class="form-control @error('poster') is-invalid @enderror"
                           accept="image/*">
                    @error('poster')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <p class="text-muted mt-2" style="font-size: 0.78rem">
                        Disarankan ukuran poster 2:3 dengan resolusi yang cukup tinggi.
                    </p>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2 flex-wrap">
                <a href="{{ route('admin.movies.index') }}"
                   class="btn btn-secondary-soft btn-pill">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary btn-pill">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
