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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('order_id')->nullable()->index();
            $table->foreignId('product_id')->nullable()->index();
            $table->string('unit',20)->nullable();
            $table->integer('qty')->nullable();
            $table->float('rate')->nullable();
            $table->float('discount')->nullable();
            $table->float('taxable')->nullable();
            $table->integer('gst')->nullable();
            $table->float('cgst')->nullable();
            $table->float('sgst')->nullable();
            $table->float('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
