@extends('layouts.app')

@section('content')
@php
    $movie  = $schedule->movie;
    $studio = $schedule->studio;
    $cinema = $studio->cinema;
    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : \Carbon\Carbon::parse($schedule->start_time);

    // kalau seat_code kamu formatnya A1, A2, dst — kita sort biar rapi
    $sortedSeats = $seats->sortBy('seat_code');
@endphp

<h1 class="page-title mb-2">Kursi (Read Only)</h1>
<p class="text-muted mb-3">
    {{ $movie->title }} · {{ $cinema->name }} · {{ $studio->name }} · {{ $start->format('d-m-Y H:i') }} WIB
</p>

<div class="card-glass p-4">
    <div class="mb-3 d-flex gap-2 flex-wrap">
        <span class="badge bg-success rounded-pill px-3">Tersedia</span>
        <span class="badge bg-secondary rounded-pill px-3">Terbooking</span>
    </div>

    <div class="seat-grid-admin">
        @foreach($sortedSeats as $seat)
            @php $isBooked = in_array($seat->id, $bookedSeatIds); @endphp
            <div class="seat-item-admin {{ $isBooked ? 'is-booked' : 'is-free' }}">
                {{ $seat->seat_code }}
            </div>
        @endforeach
    </div>
</div>
@endsection
