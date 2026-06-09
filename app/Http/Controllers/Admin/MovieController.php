<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'duration'    => 'required|integer',
            'genre'       => 'required',
            'age_rating'  => 'required',
            'base_price'  => 'required|numeric',
            'poster'      => 'nullable|image',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        Movie::create($data);

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Film berhasil ditambahkan');
    }

    /**
     * ✅ DETAIL FILM ADMIN
     * - filter jadwal per hari (?date=YYYY-MM-DD)
     * - tampilkan kursi tersedia tiap jadwal
     */
    public function show(Request $request, Movie $movie)
    {
        $date = $request->query('date');

        // default: hari ini
        $selectedDate = $date ? Carbon::parse($date)->startOfDay() : now()->startOfDay();
        $endDate      = (clone $selectedDate)->endOfDay();

        // ambil jadwal film di tanggal itu
        $schedules = Schedule::with(['studio.cinema', 'studio.seats'])
            ->where('movie_id', $movie->id)
            ->whereBetween('start_time', [$selectedDate, $endDate])
            ->orderBy('start_time', 'asc')
            ->get();

        // hitung kursi tersedia per schedule
        $scheduleStats = $schedules->map(function ($schedule) {
            $totalSeats = $schedule->studio?->seats?->count() ?? 0;

            $bookedCount = Ticket::whereHas('booking', function ($q) use ($schedule) {
                    $q->where('schedule_id', $schedule->id)
                      ->where('status', 'paid');
                })
                ->distinct('seat_id')
                ->count('seat_id');

            return [
                'schedule'     => $schedule,
                'total_seats'  => $totalSeats,
                'booked_seats' => $bookedCount,
                'available'    => max($totalSeats - $bookedCount, 0),
            ];
        });

        return view('admin.movies.show', [
            'movie'         => $movie,
            'selectedDate'  => $selectedDate,
            'scheduleStats' => $scheduleStats,
        ]);
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'duration'    => 'required|integer',
            'genre'       => 'required',
            'age_rating'  => 'required',
            'base_price'  => 'required|numeric',
            'poster'      => 'nullable|image',
        ]);

        if ($request->hasFile('poster')) {
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Film berhasil diupdate');
    }

    public function destroy(Movie $movie)
    {
        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Film dihapus');
    }
}
