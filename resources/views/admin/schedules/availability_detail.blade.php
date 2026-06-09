@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    $movie  = $schedule->movie;
    $studio = $schedule->studio;
    $cinema = $studio->cinema;
    $start  = Carbon::parse($schedule->start_time);

    // seats grouped per row: A, B, C...
    $seatRows = $studio->seats
        ->sortBy(function ($s) {
            preg_match('/^([A-Za-z]+)(\d+)$/', $s->seat_code, $m);
            $row = strtoupper($m[1] ?? 'Z');
            $num = intval($m[2] ?? 0);
            return $row.'-'.str_pad((string)$num, 4, '0', STR_PAD_LEFT);
        })
        ->groupBy(function ($s) {
            preg_match('/^([A-Za-z]+)/', $s->seat_code, $m);
            return strtoupper($m[1] ?? '-');
        });

    // ambil max angka kursi (buat header 1..N)
    $maxCols = $seatRows
        ->map(function ($rowSeats) {
            return $rowSeats->map(function ($s) {
                preg_match('/\d+/', $s->seat_code, $mm);
                return intval($mm[0] ?? 0);
            })->max();
        })
        ->max() ?? 10;

    $aisleAfter = 5; // 5-5 aisle (ubah kalau mau 4-4 dll)
@endphp

<div class="seat-header-wrap">
    <div class="seat-header">
        <h1 class="seat-title">Kursi Studio</h1>

        <div class="seat-subtitle">
            <span class="seat-subtitle-movie">{{ $movie->title }}</span>
            <span class="seat-dot">•</span>
            <span>{{ $cinema->name }} ({{ $studio->name }})</span>
            <span class="seat-dot">•</span>
            <span class="seat-subtitle-time">
                {{ $start->format('d-m-Y H:i') }} WIB
            </span>
        </div>
    </div>

    <a href="{{ route('admin.schedules.availability', ['date' => $start->toDateString()]) }}"
       class="btn-back">
        ← Kembali
    </a>
</div>


<div class="seatroom">

    <div class="seatroom-legend">
        <div class="legend-pill">
            <span class="dot dot-free"></span> Tersedia
        </div>
        <div class="legend-pill">
            <span class="dot dot-booked"></span> Terbooking
        </div>
    </div>

    <div class="screen-wrap">
        <div class="screen-glow"></div>
        <div class="screen-text">LAYAR</div>
    </div>

    {{-- Header angka (CUMA ANGKA, JANGAN PAKE $rowLetter) --}}
    <div class="seat-cols">
        <div class="seat-cols-spacer"></div>
        <div class="seat-cols-grid" style="--cols: {{ $maxCols }}; --aisleAfter: {{ $aisleAfter }};">
            @for($i = 1; $i <= $maxCols; $i++)
                <div class="col-num {{ $i == $aisleAfter ? 'after-aisle' : '' }}">
                    {{ $i }}
                </div>
            @endfor
        </div>
    </div>

    {{-- Seat map --}}
    <div class="seat-map" style="--cols: {{ $maxCols }}; --aisleAfter: {{ $aisleAfter }};">
        @foreach($seatRows as $rowLetter => $rowSeats)
            <div class="seat-row">
                <div class="row-letter">{{ $rowLetter }}</div>

                <div class="row-grid">
                    @for($i = 1; $i <= $maxCols; $i++)
                        @php
                            // cari seat sesuai nomor kolom (misal A5)
                            $seat = $rowSeats->first(function ($s) use ($i) {
                                preg_match('/\d+/', $s->seat_code, $mm);
                                return intval($mm[0] ?? 0) === $i;
                            });

                            $isBooked = $seat ? in_array($seat->id, $bookedSeatIds) : false;
                        @endphp

                        @if($seat)
                            <div class="seat {{ $isBooked ? 'seat-booked' : 'seat-free' }}"
                                 style="{{ $i == $aisleAfter ? 'margin-right: var(--aisleGap);' : '' }}"
                                 title="{{ $seat->seat_code }} - {{ $isBooked ? 'Terbooking' : 'Tersedia' }}">
                                {{ $seat->seat_code }}
                            </div>
                        @else
                            {{-- kalau tidak ada seat di posisi itu, kosongin slotnya biar rapi --}}
                            <div class="seat seat-empty"
                                 style="{{ $i == $aisleAfter ? 'margin-right: var(--aisleGap);' : '' }}">
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
