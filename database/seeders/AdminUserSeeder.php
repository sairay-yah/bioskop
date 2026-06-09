<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin1'],
            [
                'name'     => 'Admin Bioskop',
                'email'    => 'admin@example.com',
                'password' => Hash::make('admin987'),
                'role'     => 'admin',
            ]
        );
    }
}
