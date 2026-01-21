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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->string('level_pedas');

            $table->string('keterangan');

            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');

            $table->string('bukti')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
