<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        $cinema = Cinema::first();

        // Kalau belum ada cinema (misal CinemaSeeder belum jalan), hentikan
        if (! $cinema) {
            return;
        }

        // Buat beberapa studio di bioskop itu
        Studio::updateOrCreate(
            ['cinema_id' => $cinema->id, 'name' => 'Studio 1'],
            []
        );

        Studio::updateOrCreate(
            ['cinema_id' => $cinema->id, 'name' => 'Studio 2'],
            []
        );
    }
}
