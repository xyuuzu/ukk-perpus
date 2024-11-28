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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamen')->cascadeOnDelete();
            $table->date('tanggal_pengembalian');
            $table->string('kondisi_buku', 50)->default('baik');
            $table->integer('denda')->nullable();
            $table->enum('status',['tepat_waktu', 'terlambat'])->default('tepat_waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
