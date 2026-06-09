<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Joker',
                'description' => 'Seorang pria yang tersisih perlahan berubah menjadi sosok Joker di tengah tekanan sosial dan mental yang terus memburuk.',
                'duration' => 122,
                'genre' => 'Psychological Thriller',
                'age_rating' => 'D17+',
                'base_price' => 40000,
                'poster' => 'posters/2tBRNksfHswmRaqMRByFnnZSYPZlqSwV2Iqq3ZLl.webp',
            ],
            [
                'title' => 'How to Make Millions Before Grandma Dies',
                'description' => 'Seorang cucu mendadak merawat neneknya dengan motif tersembunyi, lalu terjebak dalam hubungan keluarga yang hangat sekaligus emosional.',
                'duration' => 127,
                'genre' => 'Drama Family',
                'age_rating' => 'SU',
                'base_price' => 35000,
                'poster' => 'posters/dh2Hwe1Ck5csmrCtHRrjfDnfxWLveNW7IcHJqKdY.jpg',
            ],
            [
                'title' => 'Mission: Impossible The Final Reckoning',
                'description' => 'Ethan Hunt kembali menghadapi misi berbahaya yang mempertaruhkan masa depan dunia dan tim yang ia lindungi.',
                'duration' => 163,
                'genre' => 'Action',
                'age_rating' => 'D17+',
                'base_price' => 45000,
                'poster' => 'posters/Dlkjb07NnsG1gdAP5PadyWegh19wX3xUK8BfiFUd.jpg',
            ],
            [
                'title' => 'Pengabdi Setan',
                'description' => 'Sebuah keluarga diteror kejadian mistis setelah kematian sang ibu, membawa mereka ke rahasia kelam yang sulit dijelaskan.',
                'duration' => 107,
                'genre' => 'Horror',
                'age_rating' => 'D17+',
                'base_price' => 35000,
                'poster' => 'posters/H3UWjGCVBahhCzkhiW0xYLflseXMAoLpgmCSYdab.webp',
            ],
            [
                'title' => 'Interstellar',
                'description' => 'Sekelompok penjelajah melakukan perjalanan antarbintang untuk mencari harapan baru bagi umat manusia.',
                'duration' => 169,
                'genre' => 'Sci-Fi',
                'age_rating' => 'SU',
                'base_price' => 40000,
                'poster' => 'posters/hQq8tfFqcWIJPTXHRa5O3gCPrURTdaOTzxNgKyJK.jpg',
            ],
            [
                'title' => 'How to Train Your Dragon',
                'description' => 'Seorang remaja Viking membangun persahabatan tak terduga dengan seekor naga dan mengubah pandangan desanya selamanya.',
                'duration' => 98,
                'genre' => 'Animation Adventure',
                'age_rating' => 'SU',
                'base_price' => 35000,
                'poster' => 'posters/IFjLeokMGbmPFkJVvtdeYTjZmJruQFKUKjotUbM1.webp',
            ],
            [
                'title' => 'Superman',
                'description' => 'Pahlawan Krypton kembali berdiri di antara harapan, tanggung jawab, dan ancaman yang menekan manusia di Bumi.',
                'duration' => 129,
                'genre' => 'Superhero',
                'age_rating' => 'SU',
                'base_price' => 45000,
                'poster' => 'posters/OupbNhbg5sPG25iOaS23bUXEEsx1eEiBHH7ZSAG1.webp',
            ],
            [
                'title' => 'Captain Marvel',
                'description' => 'Carol Danvers menemukan kembali masa lalunya sekaligus kekuatan kosmik yang menjadikannya salah satu harapan terbesar umat manusia.',
                'duration' => 124,
                'genre' => 'Superhero',
                'age_rating' => 'SU',
                'base_price' => 40000,
                'poster' => 'posters/PJIAqHlfJuH27NFQe4jWb2x56w3hx9F2bilqmW5F.webp',
            ],
            [
                'title' => 'Avatar: The Way Of Water',
                'description' => 'Keluarga Sully bertahan hidup di dunia Pandora yang semakin berbahaya dan menemukan tantangan baru di lautan.',
                'duration' => 192,
                'genre' => 'Sci-Fi Adventure',
                'age_rating' => 'SU',
                'base_price' => 50000,
                'poster' => 'posters/VUtTgCrY1bjj7RSpRAIiXFrXm1okjMYKNGGgvXcv.jpg',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::updateOrCreate(
                ['title' => $movie['title']],
                $movie
            );
        }
    }
}