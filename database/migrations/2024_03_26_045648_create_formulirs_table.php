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
        Schema::create('formulirs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('register_id')->constrained('registers')->restrictOnDelete();
            $table->foreignId('tahun_ajaran_id')->constrained('ref_tahun_ajaran')->restrictOnDelete();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap', 200);
            $table->string('email', 100)->unique();
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->enum('kebangsaan', ['WNI', 'WNA'])->default('WNI');
            $table->enum('status_pernikahan', ['lajang', 'menikah','pernah menikah'])->default('lajang');
            $table->string('alamat', 200)->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->string('nama_kantor', 100)->nullable();
            $table->string('alamat_kantor', 100)->nullable();
            $table->string('telepon_kantor', 100)->nullable();
            $table->string('pendidikan_terakhir', 100)->nullable();
            $table->string('nama_instansi_pendidikan', 100)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->string('tahun_lulus', 4)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulirs');
    }
};
