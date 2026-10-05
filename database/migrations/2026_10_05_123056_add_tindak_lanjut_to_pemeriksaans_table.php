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
        Schema::table('pemeriksaans', function (Blueprint $table) {
            $table->enum('tindak_lanjut', ['tidak_perlu', 'perlu', 'selesai'])
                ->default('tidak_perlu')->after('status_gizi');
        });
    }

    public function down(): void
    {
        Schema::table('pemeriksaans', fn (Blueprint $table) => $table->dropColumn('tindak_lanjut'));
    }
};
