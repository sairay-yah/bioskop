<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Studio;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('movie', 'studio.cinema')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $movies  = Movie::orderBy('title')->get();
        $studios = Studio::with('cinema')->orderBy('name')->get();

        return view('admin.schedules.create', compact('movies', 'studios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'studio_id'  => 'required|exists:studios,id',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        Schedule::create($data);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal dibuat');
    }

    /**
     * ✅ FILTER JADWAL PER HARI (ADMIN)
     * URL: /admin/schedules/availability?date=YYYY-MM-DD
     */
    public function availability(Request $request)
    {
        $date = $request->query('date')
            ? Carbon::parse($request->query('date'))->toDateString()
            : now()->toDateString();

        $schedules = Schedule::with(['movie', 'studio.cinema', 'studio.seats'])
            ->whereDate('start_time', $date)
            ->orderBy('start_time', 'asc')
            ->get();

        $scheduleIds = $schedules->pluck('id');

        $tickets = Ticket::query()
            ->whereHas('booking', function ($q) use ($scheduleIds) {
                $q->whereIn('schedule_id', $scheduleIds)
                  ->where('status', 'paid');
            })
            ->with(['booking:id,schedule_id'])
            ->get(['id', 'booking_id', 'seat_id']);

        $bookedSeatIdsBySchedule = $tickets
            ->groupBy(fn ($t) => optional($t->booking)->schedule_id)
            ->map(fn ($group) => $group->pluck('seat_id')->unique()->values());

        return view('admin.schedules.availability', [
            'date' => $date,
            'schedules' => $schedules,
            'bookedSeatIdsBySchedule' => $bookedSeatIdsBySchedule,
        ]);
    }

    /**
     * ✅ DETAIL KURSI PER JADWAL (ADMIN)
     * URL: /admin/schedules/{schedule}/availability
     */
    public function availabilityDetail(Schedule $schedule)
    {
        $schedule->load(['movie', 'studio.cinema', 'studio.seats']);

        $bookedSeatIds = Ticket::whereHas('booking', function ($q) use ($schedule) {
                $q->where('schedule_id', $schedule->id)
                  ->where('status', 'paid');
            })
            ->pluck('seat_id')
            ->unique()
            ->values()
            ->toArray();

        return view('admin.schedules.availability_detail', [
            'schedule' => $schedule,
            'bookedSeatIds' => $bookedSeatIds,
        ]);
    }

    public function show(Schedule $schedule)
    {
        $schedule->load(['movie', 'studio.cinema', 'studio.seats']);

        $totalSeats = $schedule->studio?->seats?->count() ?? 0;

        $bookedSeatIds = Ticket::whereHas('booking', function ($q) use ($schedule) {
                $q->where('schedule_id', $schedule->id)
                  ->where('status', 'paid');
            })
            ->pluck('seat_id')
            ->unique()
            ->values()
            ->toArray();

        $bookedCount = count($bookedSeatIds);
        $available   = max($totalSeats - $bookedCount, 0);

        return view('admin.schedules.show', [
            'schedule'      => $schedule,
            'totalSeats'    => $totalSeats,
            'bookedCount'   => $bookedCount,
            'available'     => $available,
            'bookedSeatIds' => $bookedSeatIds,
        ]);
    }

    public function edit(Schedule $schedule)
    {
        $movies  = Movie::orderBy('title')->get();
        $studios = Studio::with('cinema')->orderBy('name')->get();

        return view('admin.schedules.edit', compact('schedule', 'movies', 'studios'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        // ✅ INI YANG TADI ERROR token "=" biasanya dari sini
        $data = $request->validate([
            'movie_id'   => 'required|exists:movies,id',
            'studio_id'  => 'required|exists:studios,id',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
        ]);

        $schedule->update($data);

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal diupdate');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()
            ->route('admin.schedules.index')
            ->with('success', 'Jadwal dihapus');
    }
}
