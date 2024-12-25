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
        Schema::table('pengaduan_masyarakat', function (Blueprint $table) {
            $table->unsignedBigInteger('masyarakat_id')->after('id');
            $table->foreign('masyarakat_id')->references('id')->on('masyarakat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduan_masyarakat', function (Blueprint $table) {
            $table->dropForeign('masyarakat_id');
            $table->dropColumn('masyarakat_id');
        });
    }
};
