<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // atur pola kursi di sini
        $rows = ['A', 'B', 'C', 'D', 'E'];      // baris
        $numbers = range(1, 10);               // nomor 1–10

        $studios = Studio::all();

        foreach ($studios as $studio) {
            foreach ($rows as $row) {
                foreach ($numbers as $num) {
                    Seat::create([
                        'studio_id' => $studio->id,
                        'seat_code' => $row . $num,   // contoh: A1, A2, ..., E10
                    ]);
                }
            }
        }
    }
}
