<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      User::create([
            'name' => 'Nazril',
            'email' => 'Nazril@gmail.com',
            'password' => bcrypt('nazril'),
            'role' => 'admin'

        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'Petugas@gmail.com',
            'password' => bcrypt('petugas'),
            'role' => 'petugas'

        ]);
    }
}