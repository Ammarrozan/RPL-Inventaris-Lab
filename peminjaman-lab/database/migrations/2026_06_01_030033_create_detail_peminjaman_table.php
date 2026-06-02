<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_barang');
            $table->integer('kuantitas_pinjam')->default(1);
            $table->integer('kuantitas_kembali')->default(0);
            $table->timestamp('waktu_kembali')->nullable();
            $table->timestamps();

            $table->foreign('id_peminjaman')->references('id')->on('transaksi')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_peminjaman');
    }
};
