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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained()->restrictOnDelete();
            $table->foreignId('jadwal_id')->constrained()->restrictOnDelete();
            $table->foreignId('pemeriksa_id')->constrained('users')->restrictOnDelete();
            $table->date('tanggal');
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('lingkar_kepala', 5, 2)->nullable();
            $table->decimal('lingkar_lengan', 5, 2)->nullable();
            $table->string('tekanan_darah', 10)->nullable(); // contoh: 120/80
            $table->unsignedSmallInteger('gula_darah')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status_gizi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
