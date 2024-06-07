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
        Schema::create('penjuals', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_harga', 10, 2)->nullable();
            $table->integer('pelanggan_id');
            $table->integer('user_id');
            $table->date('date');
            $table->decimal('return', 10,2);
            $table->decimal('payment', 10,2);
            $table->decimal('price_amount',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjuals');
    }
};