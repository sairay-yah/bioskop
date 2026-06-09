<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $studios = Studio::with('cinema')->orderBy('name')->get();

        if ($studios->isEmpty()) {
            return;
        }

        $schedulePlan = [
            ['title' => 'Joker', 'studio' => 0, 'day' => 1, 'time' => '13:00'],
            ['title' => 'How to Make Millions Before Grandma Dies', 'studio' => 1, 'day' => 1, 'time' => '16:00'],
            ['title' => 'Mission: Impossible The Final Reckoning', 'studio' => 0, 'day' => 1, 'time' => '19:00'],
            ['title' => 'Pengabdi Setan', 'studio' => 1, 'day' => 2, 'time' => '13:30'],
            ['title' => 'Interstellar', 'studio' => 0, 'day' => 2, 'time' => '17:00'],
            ['title' => 'How to Train Your Dragon', 'studio' => 1, 'day' => 2, 'time' => '20:00'],
            ['title' => 'Superman', 'studio' => 0, 'day' => 3, 'time' => '12:30'],
            ['title' => 'Captain Marvel', 'studio' => 1, 'day' => 3, 'time' => '15:30'],
            ['title' => 'Avatar: The Way Of Water', 'studio' => 0, 'day' => 3, 'time' => '19:30'],
        ];

        foreach ($schedulePlan as $item) {
            $movie = Movie::where('title', $item['title'])->first();

            if (! $movie) {
                continue;
            }

            $studio = $studios->get($item['studio']) ?? $studios->first();
            if (! $studio) {
                continue;
            }

            $startTime = Carbon::now()
                ->addDays($item['day'])
                ->setTimeFromTimeString($item['time']);

            $endTime = (clone $startTime)->addMinutes($movie->duration + 15);

            Schedule::updateOrCreate(
                [
                    'movie_id' => $movie->id,
                    'studio_id' => $studio->id,
                    'start_time' => $startTime,
                ],
                [
                    'end_time' => $endTime,
                ]
            );
        }
    }
}