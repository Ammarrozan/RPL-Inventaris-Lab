<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // Pastikan ini ada di paling atas

return new class extends Migration
{
    public function up(): void
    {
        // Ganti Route menjadi Schema
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role_id setelah kolom email
            $table->foreignId('role_id')->nullable()->after('email')->constrained('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Ganti Route menjadi Schema
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
