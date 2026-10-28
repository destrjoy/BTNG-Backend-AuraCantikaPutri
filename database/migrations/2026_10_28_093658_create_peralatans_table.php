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
    Schema::create('peralatan', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('brand');
        $table->string('kategori');
        $table->text('deskripsi')->nullable();
        $table->decimal('harga_sewa', 12, 2);
        $table->unsignedInteger('stok')->default(0);
        $table->enum('kondisi', ['baru', 'baik', 'perlu_perbaikan'])->default('baik');
        $table->enum('status', ['tersedia', 'tidak_tersedia'])->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peralatans');
    }
};
