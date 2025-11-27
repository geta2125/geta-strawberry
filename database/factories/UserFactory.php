<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // <--- Wajib ada
use Illuminate\Support\Facades\Http;    // <--- Wajib ada

class UserFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->name();

        // 1. Siapkan nama file unik di folder profile_pictures
        // Folder ini harus sesuai dengan logic di Controller Anda
        $filename = 'profile_pictures/' . Str::random(20) . '.png';

        // 2. Download gambar dummy berdasarkan inisial nama
        // Contoh: Budi Santoso -> Gambar Inisial "BS"
        $imageUrl = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&color=fff&size=200";

        // 3. Ambil konten gambar dari internet
        $imageContent = Http::get($imageUrl)->body();

        // 4. Simpan file fisik ke storage (storage/app/public/profile_pictures)
        Storage::disk('public')->put($filename, $imageContent);

        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),

            // 5. Simpan path string ke database
            'profile_picture' => $filename,
        ];
    }
}
