<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan_masyarakat', function (Blueprint $table) {
          $table->id();
          $table->string('nama_pengaduan');
          $table->date('tgl_pengaduan');
          $table->text('deskripsi');
          $table->text('lokasi_pengaduan');
          $table->string('foto_pengaduan', 45);
          $table->enum('status', ['Belum diproses', 'Proses', 'Selesai'])->default('Belum diproses');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan_masyarakat');
    }
};
