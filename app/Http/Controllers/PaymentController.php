<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        $booking->load('schedule.movie','schedule.studio.cinema','payment','tickets.seat');

        return view('payment.show', compact('booking'));
    }

    /**
     * ✅ Refresh button: langsung tandai paid dan lempar ke E-Ticket
     */
    public function refreshToTicket(Request $request, Booking $booking)
    {
        // pastikan relasi ada
        $booking->load('payment', 'tickets');

        // kalau belum ada payment (harusnya ada), bikin biar aman
        if (!$booking->payment) {
            $booking->payment()->create([
                'method'  => 'qris',
                'amount'  => $booking->total_price,
                'status'  => 'pending',
            ]);
            $booking->refresh();
        }

        // ✅ set paid
        $booking->payment->update([
            'status'  => 'paid', // IMPORTANT: enum kamu 'paid', bukan 'success'
            'paid_at' => now(),
        ]);

        $booking->update([
            'status' => 'paid',
        ]);

        $firstTicket = $booking->tickets->first();

        if (!$firstTicket) {
            return redirect()->route('bookings.history')
                ->with('error', 'Tiket belum tersedia untuk booking ini.');
        }

        return redirect()->route('tickets.show', $firstTicket->id)
            ->with('success', 'Pembayaran berhasil, tiket sudah aktif.');
    }
}
