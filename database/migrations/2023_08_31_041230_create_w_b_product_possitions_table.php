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
        Schema::create('w_b_product_possitions', function (Blueprint $table) {
            $table->id();
            $table->string('brand_id');
            $table->string('sku');
            $table->string('keyword');
            $table->integer('position')->nullable();
            $table->integer('ads')->default(0);
            $table->string('position_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('w_b_product_possitions');
    }
};
