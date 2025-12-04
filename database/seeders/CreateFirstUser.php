<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Admin Manual
        User::create([
            'name' => 'geta',
            'email' => 'geta24si@mahasiswa.pcr',
            'password' => Hash::make('geta2125')
        ]);

        // 2. Buat 50 User Random (dengan foto otomatis dari Factory)
        User::factory(50)->create();
    }
}
