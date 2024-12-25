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
        Schema::create('masyarakat', function (Blueprint $table) {
          $table->id();
          $table->string('nik', 16)->unique();
          $table->string('no_telepon', 15);
          $table->text('alamat');
          $table->enum('gender', ['Laki-Laki', 'Perempuan']);
          $table->string('foto', 45)->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masyarakat');
    }
};
