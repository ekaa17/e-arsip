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
        Schema::create('perguruan_tinggi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_perguruan_tinggi', 100); // (1)
            $table->string('nama_perguruan_tinggi', 200);
            $table->string('telepon', 20);
            $table->string('email', 100);
            $table->string('website', 100);
            $table->string('jalan', 200);
            $table->string('dusun', 100);
            $table->string('rt_rw', 100);
            $table->string('kelurahan', 100);
            $table->string('kode_pos', 10);
            $table->string('bank');
            $table->string('unit_cabang');
            $table->string('nomor_rekening');
            $table->string('sk_pendirian');
            $table->date('tanggal_sk_pendirian');
            $table->string('sk_izin_operasional');
            $table->date('tanggal_sk_izin_operasional');
            $table->string('predikat_akreditasi');
            $table->string('sk_akreditasi');
            $table->date('tanggal_sk_akreditasi');
            $table->text('logo', 100);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguruan_tinggi');
    }
};
