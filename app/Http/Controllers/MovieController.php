<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Tampilkan detail satu film untuk pengguna (pelanggan)
     */
    public function show(Movie $movie)
    {
        // Load relasi jadwal, studio, dan bioskop agar tidak N+1 query
        $movie->load('schedules.studio.cinema');

        // Ambil jadwal film ini, diurutkan berdasarkan waktu mulai
        $schedules = $movie->schedules()
            ->with('studio.cinema')
            ->orderBy('start_time')
            ->get();

        // kirim $movie dan $schedules ke view
        return view('movies.show', compact('movie', 'schedules'));
    }
}
