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
        Schema::create('ref_prodi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('jenjang_pendidikan_id')->constrained('ref_jenjang_pendidikan');
            $table->string('kode_dikti', 10)->nullable();
            $table->string('kode', 5)->unique();
            $table->string('nama_prodi', 100);
            $table->string('singkatan', 10);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('ref_prodi');
    }
};
