<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Studio;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        $studios = Studio::with('cinema','seats')->get();
        return view('admin.seats.index', compact('studios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'rows'      => 'required|integer|min:1',
            'cols'      => 'required|integer|min:1',
        ]);

        $studio = Studio::findOrFail($data['studio_id']);

        // generate A1..A10, B1..B10
        for ($r = 0; $r < $data['rows']; $r++) {
            $rowLetter = chr(65 + $r); // 65 = A
            for ($c = 1; $c <= $data['cols']; $c++) {
                Seat::firstOrCreate([
                    'studio_id' => $studio->id,
                    'seat_code' => $rowLetter.$c,
                ]);
            }
        }

        return back()->with('success','Kursi berhasil digenerate');
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return back()->with('success','Kursi dihapus');
    }
}
