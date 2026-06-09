<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya 1 bioskop (sesuai requirement kamu)
        Cinema::updateOrCreate(
            ['name' => 'CGV Blok M'],
            [
                'address' => 'Jalan in aja doeloe No. 123, Jakarta Selatan',
            ]
        );
    }
}
