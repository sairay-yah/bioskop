<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $bookings = $user->bookings()
            ->with('schedule.movie','schedule.studio.cinema','tickets.seat')
            ->orderByDesc('created_at')
            ->get();

        $now = now();

        $aktif = $bookings->filter(fn ($b) => $b->status === 'paid' && $b->schedule->start_time >= $now);
        $lewat = $bookings->filter(fn ($b) => $b->status === 'paid' && $b->schedule->start_time < $now);

        return view('profile.index', compact('user','bookings','aktif','lewat'));
    }
}
