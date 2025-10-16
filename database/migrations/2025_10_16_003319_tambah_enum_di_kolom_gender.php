<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mengubah struktur tabel 'pelanggan'
        Schema::table('pelanggan', function (Blueprint $table) {
            // Ubah kolom 'gender'.
            // PENTING: Anda harus mendaftarkan SEMUA nilai yang sudah ada DITAMBAH nilai baru.
            $table->enum('gender', ['Male', 'Female', 'Other', 'Waria'])
                ->nullable() // Pastikan modifier lain seperti nullable tetap ada
                ->change();  // Perintah ->change() untuk menerapkan modifikasi
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
