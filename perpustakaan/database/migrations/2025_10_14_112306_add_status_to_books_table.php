<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Menambahkan kolom status setelah 'cover_image'
            $table->enum('status', ['AVAILABLE', 'BORROWED'])->default('AVAILABLE')->after('cover_image');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Menghapus kolom status jika migrasi di-rollback
            $table->dropColumn('status');
        });
    }
};