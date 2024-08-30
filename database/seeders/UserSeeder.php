<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'Дамир Гарипов',
           'email' => '12@rer.com',
           'password' => '$2y$10$PRH1xjFgHliTCDqJXuSuY.DoSR79L3pK1Odi6IcJylqW7DqcSzpsG',
           'role' => '1',
        ]);
    }
}
