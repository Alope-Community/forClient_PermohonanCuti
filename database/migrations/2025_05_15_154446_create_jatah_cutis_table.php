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
        Schema::create('jatah_cutis', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->date('tahun');
            $table->integer('total_jatah');
            $table->integer('sisa_jatah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jatah_cutis');
    }
};
