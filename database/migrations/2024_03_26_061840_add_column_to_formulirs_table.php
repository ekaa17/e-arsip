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
        Schema::table('formulirs', function (Blueprint $table) {
            $table->foreignUuid('pilihan_prodi_id')->constrained('ref_prodi')->after('tahun_ajaran_id');
            $table->foreignId('provinsi_id')->constrained('ref_provinsi')->after('pilihan_prodi_id');
            $table->foreignId('kabupaten_kota_id')->constrained('ref_kabupaten_kota')->after('provinsi_id');
            $table->foreignId('kecamatan_id')->constrained('ref_kecamatan')->after('kabupaten_kota_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pilihan_prodi_id');
            $table->dropConstrainedForeignId('provinsi_id');
            $table->dropConstrainedForeignId('kabupaten_kota_id');
            $table->dropConstrainedForeignId('kecamatan_id');
        });
    }
};
