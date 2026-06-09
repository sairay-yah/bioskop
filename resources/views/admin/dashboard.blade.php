@extends('layouts.app')

@section('content')
<h2>Admin Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                Total Booking: {{ $totalBooking }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                Booking Paid: {{ $totalPaid }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                Total Income: Rp {{ number_format($totalIncome,0,',','.') }}
            </div>
        </div>
    </div>
</div>
@endsection
