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
        Schema::create('laporan_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('cuti_id')->constrained('cutis')->cascadeOnDelete();
            $table->foreignId('nama_karyawan')->references('id')->on('users')->cascadeOnDelete();
            $table->string('diterbitkan_oleh')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('jumlah_hari');
            $table->text('alasan')->nullable();
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_cutis');
    }
};
