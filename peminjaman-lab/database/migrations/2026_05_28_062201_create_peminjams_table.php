<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('barang');
            $table->foreignId('id_user')->constrained('users');
            $table->string('nim');
            $table->string('nama');
            $table->string('no_hp');
            $table->foreignId('id_status_mahasiswa')->constrained('status_mahasiswa');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
