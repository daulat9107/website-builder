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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->foreignId('firm_id')->nullable()->index();
            $table->foreignId('group_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('pan')->nullable();
            $table->string('gstin')->nullable();
            $table->string('mobile')->nullable();
            $table->string('alternative_mobile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
