@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-3">{{ $movie->title }}</h1>

    @if($movie->poster)
        <img src="{{ asset('storage/' . $movie->poster) }}" 
             alt="Poster {{ $movie->title }}" 
             style="width:250px; border-radius:8px;" 
             class="mb-4">
    @endif

    <p><strong>Genre:</strong> {{ $movie->genre }}</p>
    <p><strong>Durasi:</strong> {{ $movie->duration }} menit</p>
    <p><strong>Rating Umur:</strong> {{ $movie->age_rating }}</p>

    <hr>

    <h4>Deskripsi</h4>
    <p>{{ $movie->description }}</p>

    <hr>

    <h4>Jadwal Tersedia</h4>

    @if(isset($schedules) && count($schedules) > 0)
        <ul>
            @foreach($schedules as $schedule)
                <li>
                    <strong>{{ $schedule->start_time }}</strong>
                    — Studio: {{ $schedule->studio->name ?? 'Tidak ada info studio' }}
                </li>
            @endforeach
        </ul>
    @else
        <p><em>Belum ada jadwal untuk film ini.</em></p>
    @endif

</div>
@endsection
