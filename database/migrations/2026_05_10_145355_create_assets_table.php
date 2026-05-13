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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel categories
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('serial_number')->unique()->nullable();

            // Status barang menggunakan Enum
            $table->enum('status', ['Tersedia', 'Dipakai', 'Rusak'])->default('Tersedia');

            $table->string('held_by')->nullable(); // Nama peminjam/pemegang
            $table->integer('stock')->default(0);  // Untuk trigger alert stok rendah
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
