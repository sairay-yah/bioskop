<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function selectSeats(Schedule $schedule)
    {
        $schedule->load('studio.seats', 'movie', 'studio.cinema');

        $bookedSeatIds = Ticket::whereHas('booking', function ($q) use ($schedule) {
                $q->where('schedule_id', $schedule->id)
                  ->where('status', 'paid');
            })
            ->pluck('seat_id')
            ->toArray();

        return view('bookings.seats', [  // ✅ FIX DI SINI
            'schedule'      => $schedule,
            'seats'         => $schedule->studio->seats,
            'bookedSeatIds' => $bookedSeatIds,
        ]);
    }

    public function checkout(Request $request, Schedule $schedule)
    {
        $request->validate([
            'seat_ids' => ['required', 'array', 'min:1'],
        ], [
            'seat_ids.required' => 'Silakan pilih minimal 1 kursi.',
            'seat_ids.min'      => 'Silakan pilih minimal 1 kursi.',
        ]);

        $seatIds = $request->seat_ids;

        $alreadyBooked = Ticket::whereIn('seat_id', $seatIds)
            ->whereHas('booking', function ($q) use ($schedule) {
                $q->where('schedule_id', $schedule->id)
                  ->where('status', 'paid');
            })
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Ada kursi yang sudah dipesan orang lain. Silakan pilih ulang.');
        }

        $user = $request->user();

        return DB::transaction(function () use ($schedule, $seatIds, $user) {
            $movie      = $schedule->movie;
            $seatCount  = count($seatIds);
            $totalPrice = $seatCount * $movie->base_price;

            $booking = Booking::create([
                'user_id'      => $user->id,
                'schedule_id'  => $schedule->id,
                'booking_code' => strtoupper(Str::random(8)),
                'seat_count'   => $seatCount,
                'total_price'  => $totalPrice,
                'status'       => 'pending',
            ]);

            foreach ($seatIds as $seatId) {
                Ticket::create([
                    'booking_id'  => $booking->id,
                    'seat_id'     => $seatId,
                    'ticket_code' => strtoupper(Str::random(10)),
                ]);
            }

            Payment::create([
                'booking_id' => $booking->id,
                'method'     => 'qris',
                'amount'     => $totalPrice,
                'status'     => 'pending',
            ]);

            return redirect()->route('payment.show', $booking);
        });
    }

    public function ticket(Ticket $ticket)
    {
        // kalau belum paid -> arahkan ke pembayaran
        if ($ticket->booking->status !== 'paid') {
            return redirect()
                ->route('payment.show', $ticket->booking->id)
                ->with('error', 'Tiket belum aktif. Silakan klik Refresh di halaman pembayaran.');
        }

        $ticket->load(
            'booking.tickets.seat',
            'booking.schedule.movie',
            'booking.schedule.studio.cinema',
            'seat'
        );

        return view('tickets.show', compact('ticket'));
    }

    public function history(Request $request)
    {
        $user = $request->user();

        $bookings = Booking::with([
                'schedule.movie',
                'schedule.studio.cinema',
                'tickets.seat',
            ])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('bookings.history', compact('bookings'));
    }
}
