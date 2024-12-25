<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('teamproject', function (Blueprint $table) {
      $table->id();
      $table->string('nama', 45);
      $table->enum('role', ['Project Manager','Frontend','Backend','Database Management','AFK'])->default('AFK');
      $table->string('program_studi', 20);
      $table->string('kampus', 60);
      $table->string('foto', 50);
      $table->string('facebook')->nullable();
      $table->string('github')->nullable();
      $table->string('instagram')->nullable();
      $table->string('discord')->nullable();
      $table->string('linkedin')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('teamproject');
  }
};
