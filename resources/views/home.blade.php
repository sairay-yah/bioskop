@extends('layouts.app')

@section('content')
<h1 class="page-title">Daftar Film</h1>

<div class="row">
    @foreach($movies as $movie)
        <div class="col-md-3 mb-4">
            <div class="card movie-card d-flex flex-column h-100">

                @if($movie->poster)
                    <img src="{{ asset('storage/' . $movie->poster) }}" 
                         class="movie-poster" 
                         alt="{{ $movie->title }}">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="movie-title mb-1">{{ $movie->title }}</h5>

                    <p class="movie-genre mb-0">
                        Genre: {{ $movie->genre }}
                    </p>
                    <p class="movie-duration mb-3">
                        Durasi: {{ $movie->duration }} menit
                    </p>

                    <div class="mt-auto pt-2">
                        <a href="{{ route('movies.show', $movie) }}" 
                           class="btn btn-primary w-100">
                            Detail
                        </a>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>
@endsection
