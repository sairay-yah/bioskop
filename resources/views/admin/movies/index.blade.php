@extends('layouts.app')

@section('content')
<div class="admin-breadcrumb mb-2">
    Admin · <span>Film</span>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="page-title mb-0">Daftar Film</h1>

    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">
        + Tambah Film
    </a>
</div>

<div class="admin-table-wrapper card card-table p-0">
    <table class="table table-borderless align-middle mb-0 admin-table">
        <thead>
        <tr>
            <th style="width: 60px;">#</th>
            <th style="width: 110px;">Poster</th>
            <th>Judul</th>
            <th style="width: 160px;">Genre</th>
            <th style="width: 130px;">Durasi</th>
            <th style="width: 150px;">Harga Dasar</th>
            <th style="width: 160px;" class="text-end">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($movies as $index => $movie)
            <tr>
                <td class="text-muted">{{ $index + 1 }}</td>
                <td>
                    @if($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}"
                             alt="{{ $movie->title }}"
                             class="rounded"
                             style="width: 70px; height: 96px; object-fit: cover;">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td class="fw-semibold">{{ $movie->title }}</td>
                <td>{{ $movie->genre }}</td>
                <td>{{ $movie->duration }} menit</td>
                <td>Rp {{ number_format($movie->base_price, 0, ',', '.') }}</td>
                <td class="text-end">
                    <a href="{{ route('admin.movies.edit', $movie) }}"
                       class="btn btn-sm btn-warning px-3 me-1">
                        Edit
                    </a>

                    <form action="{{ route('admin.movies.destroy', $movie) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger px-3">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    Belum ada film yang ditambahkan.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
