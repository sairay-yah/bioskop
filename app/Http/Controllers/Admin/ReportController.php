<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Untuk sekarang, dashboard diarahkan ke daftar film admin
    public function dashboard()
    {
        // Jika nanti mau dashboard statistik, ganti return ini dengan view('admin.dashboard', ...)
        return redirect()->route('admin.movies.index');
    }

    public function sales()
    {
        $perMovie = Booking::select('schedule_id', DB::raw('sum(total_price) as total'))
            ->where('status', 'paid')
            ->groupBy('schedule_id')
            ->with('schedule.movie')
            ->get();

        return view('admin.reports.sales', compact('perMovie'));
    }
}
