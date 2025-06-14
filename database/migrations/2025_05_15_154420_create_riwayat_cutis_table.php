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
        Schema::create('riwayat_cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuti_id')->constrained('cutis')->cascadeOnDelete();
            $table->date('tanggal_update');
            $table->enum('status', ['manajer_unit', 'manajer_sdm', 'direktur_operational', 'menunggu', 'ditolak'])->default('menunggu');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_cutis');
    }
};
