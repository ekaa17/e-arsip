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
        Schema::create('registers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_pendaftaran', 10)->unique();
            $table->string('nik', 16)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('tahun_ajaran_id')->constrained('ref_tahun_ajaran')->restrictOnDelete();
            $table->string('nama_lengkap', 200);
            $table->string('email', 100)->unique();
            $table->string('nomor_telepon', 15)->nullable();
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
