@extends('layouts.app')

@section('content')
<h2>Profil Saya</h2>

<p>Nama: {{ $user->name }}<br>
Username: {{ $user->username }}<br>
Role: {{ $user->role }}</p>

<h3>Tiket Aktif</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Film</th>
            <th>Jadwal</th>
            <th>Kursi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @forelse($aktif as $b)
        <tr>
            <td>{{ $b->schedule->movie->title }}</td>
            <td>{{ $b->schedule->start_time->format('d-m-Y H:i') }}</td>
            <td>
                @foreach($b->tickets as $t)
                    {{ $t->seat->seat_code }}
                @endforeach
            </td>
            <td>
                @if($b->tickets->count())
                    <a href="{{ route('tickets.show', $b->tickets->first()) }}" class="btn btn-sm btn-primary">Lihat Tiket</a>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="4">Tidak ada tiket aktif.</td></tr>
    @endforelse
    </tbody>
</table>

<h3>Riwayat Transaksi</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Booking</th>
            <th>Film</th>
            <th>Jadwal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bookings as $b)
        <tr>
            <td>{{ $b->booking_code }}</td>
            <td>{{ $b->schedule->movie->title }}</td>
            <td>{{ $b->schedule->start_time->format('d-m-Y H:i') }}</td>
            <td>{{ strtoupper($b->status) }}</td>
            <td>Rp {{ number_format($b->total_price,0,',','.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
