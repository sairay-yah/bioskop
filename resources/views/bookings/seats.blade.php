@extends('layouts.app')

@section('content')
@php
    use Carbon\Carbon;

    $start = $schedule->start_time instanceof \Carbon\Carbon
        ? $schedule->start_time
        : Carbon::parse($schedule->start_time);

    // ====== BUILD SEAT MAP (ROW LETTER + NUMBER) ======
    // seat_code format: A1, A2, B10, dst
    $seatMap = [];     // [rowLetter][num] = seat
    $rowOrder = [];    // keep row ordering
    $maxNum = 0;

    foreach ($seats as $s) {
        $code = $s->seat_code ?? ('K'.$s->id);

        // ambil row letter + nomor
        // contoh: A10 => row=A, num=10
        if (preg_match('/^([A-Za-z]+)\s*(\d+)$/', trim($code), $m)) {
            $row = strtoupper($m[1]);
            $num = (int) $m[2];
        } else {
            // fallback kalau seat_code aneh
            $row = 'Z';
            $num = (int) $s->id;
        }

        $seatMap[$row][$num] = $s;
        $rowOrder[$row] = true;
        if ($num > $maxNum) $maxNum = $num;
    }

    // urutkan row A..Z
    $rows = array_keys($rowOrder);
    sort($rows);

    // atur lorong (bisa ubah)
    $aisleAfter = 5;           // bikin gap setelah kolom 5
    $aisleGapPx = 18;          // jarak lorong
@endphp

<div class="booking-page container-xxl">

    <div class="row g-4 align-items-start">
        {{-- KARTU INFO FILM / JADWAL --}}
        <div class="col-lg-4">
            <div class="card booking-info-card">
                <div class="card-body">
                    <p class="booking-section-label mb-2">Tiket kamu untuk</p>
                    <h3 class="booking-movie-title mb-1">{{ $schedule->movie->title }}</h3>
                    <p class="booking-movie-subtitle mb-3">{{ $schedule->movie->description }}</p>

                    <div class="booking-movie-meta mb-3">
                        <p class="mb-1">
                            <span>Durasi</span>
                            <strong>{{ $schedule->movie->duration }} menit</strong>
                        </p>
                        <p class="mb-1">
                            <span>Genre</span>
                            <strong>{{ $schedule->movie->genre }}</strong>
                        </p>
                        <p class="mb-1">
                            <span>Rating Umur</span>
                            <strong>{{ $schedule->movie->age_rating }}</strong>
                        </p>
                        <p class="mb-1">
                            <span>Harga / Kursi</span>
                            <strong>Rp {{ number_format($schedule->movie->base_price, 0, ',', '.') }}</strong>
                        </p>
                    </div>

                    <hr class="booking-divider">

                    <div class="booking-location mb-3">
                        <p class="mb-1">
                            <span>Studio</span>
                            <strong>{{ $schedule->studio->name }}</strong>
                        </p>
                        <p class="mb-1">
                            <span>Bioskop</span>
                            <strong>{{ $schedule->studio->cinema->name }}</strong>
                        </p>
                        <p class="booking-address mb-2">
                            {{ $schedule->studio->cinema->address }}
                        </p>
                        <p class="mb-0">
                            <span>Jadwal</span>
                            <strong>{{ $start->format('d M Y · H:i') }} WIB</strong>
                        </p>
                    </div>

                    <hr class="booking-divider">

                    <div class="booking-legend">
                        <div class="legend-item">
                            <span class="legend-dot legend-dot-free"></span> Tersedia
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot legend-dot-booked"></span> Terisi
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot legend-dot-selected"></span> Dipilih
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KARTU PILIH KURSI --}}
        <div class="col-lg-8">
            <div class="card booking-seat-card">
                <div class="card-body">

                    {{-- BAR LAYAR --}}
                    <div class="screen-wrapper text-center mb-4">
                        <div class="screen-bar">LAYAR</div>
                        <p class="screen-subtitle mb-0">Pilih kursi terbaikmu menghadap layar</p>
                    </div>

                    {{-- FORM PILIH KURSI --}}
                    <form action="{{ route('booking.checkout', $schedule) }}" method="POST">
                        @csrf

                        {{-- HEADER ANGKA 1..N --}}
                        <div class="user-seat-cols mb-2">
                            <div class="user-seat-cols-spacer"></div>

                            <div class="user-seat-cols-grid"
                                 style="--cols: {{ $maxNum }}; --aisleAfter: {{ $aisleAfter }}; --aisleGap: {{ $aisleGapPx }}px;">
                                @for($i=1; $i <= $maxNum; $i++)
                                    <div class="user-col-num {{ $i == $aisleAfter ? 'after-aisle' : '' }}">
                                        {{ $i }}
                                    </div>
                                @endfor
                            </div>
                        </div>

                        {{-- SEAT MAP PER BARIS --}}
                        <div class="user-seat-map"
                             style="--cols: {{ $maxNum }}; --aisleAfter: {{ $aisleAfter }}; --aisleGap: {{ $aisleGapPx }}px;">
                            @foreach($rows as $rowLetter)
                                <div class="user-seat-row">
                                    <div class="user-row-letter">{{ $rowLetter }}</div>

                                    <div class="user-row-grid">
                                        @for($i=1; $i <= $maxNum; $i++)
                                            @php
                                                $seat = $seatMap[$rowLetter][$i] ?? null;
                                            @endphp

                                            @if($seat)
                                                @php
                                                    $booked  = in_array($seat->id, $bookedSeatIds);
                                                    $label   = $seat->seat_code ?? ($rowLetter.$i);
                                                    $inputId = 'seat-'.$seat->id;
                                                @endphp

                                                <div class="user-seat-cell {{ $i == $aisleAfter ? 'after-aisle' : '' }}">
                                                    <input
                                                        type="checkbox"
                                                        id="{{ $inputId }}"
                                                        name="seat_ids[]"
                                                        value="{{ $seat->id }}"
                                                        class="seat-checkbox"
                                                        {{ $booked ? 'disabled' : '' }}
                                                    >
                                                    <label
                                                        for="{{ $inputId }}"
                                                        class="seat-label {{ $booked ? 'seat-booked' : 'seat-free' }}"
                                                        title="{{ $booked ? 'Kursi sudah dipesan' : 'Kursi tersedia' }}"
                                                    >
                                                        {{ $label }}
                                                    </label>
                                                </div>
                                            @else
                                                {{-- placeholder biar grid tetap rapi --}}
                                                <div class="user-seat-cell placeholder {{ $i == $aisleAfter ? 'after-aisle' : '' }}"></div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @error('seat_ids')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror

                        @if(session('error'))
                            <div class="text-danger small mt-2">{{ session('error') }}</div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-2">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-light px-4 booking-btn-ghost">
                                Kembali
                            </a>
                            <button class="btn btn-primary px-4 booking-btn-primary" type="submit">
                                Lanjut ke Pembayaran
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
