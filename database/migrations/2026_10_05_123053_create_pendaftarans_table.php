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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained();
            $table->foreignId('jadwal_id')->constrained();
            $table->enum('status', ['terdaftar', 'hadir', 'tidak_hadir', 'batal'])->default('terdaftar');
            $table->timestamp('dikonfirmasi_at')->nullable();
            $table->timestamps();

            $table->unique(['warga_id', 'jadwal_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
