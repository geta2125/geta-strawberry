<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        // 1. Buat User Admin Manual
        User::create([
            'name' => 'geta',
            'email' => 'geta24si@mahasiswa.pcr',
            'password' => Hash::make('geta2125')
        ]);

        // 2. Buat 50 User Random (dengan foto otomatis dari Factory)
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password123'),
            ]);
        }
        echo "Berhasil membuat 51 users! \n";
        echo "1 Admin \n";
        echo "50 User Dummy dengan nama random \n";
    }
}

//super admin saya yaitu :
//geta24@mahasiswa.pcr
//pw:geta2125
