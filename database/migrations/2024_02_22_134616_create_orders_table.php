<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_date');
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('purchaser_id')->nullable()->index();
            $table->foreignId('supplier_id')->nullable()->index();
            $table->foreignId('agency_id')->nullable()->index();
            
            $table->float('subtotal');
            $table->float('total');
            $table->string('status',40);
            $table->text('comments');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE orders AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
