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
        Schema::create('w_b_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('brand_id');
            $table->json('sizes')->nullable();
            $table->json('media_files')->nullable();
            $table->json('colors')->nullable();
            $table->string('vendor_code')->unique();
            $table->string('brand')->nullable();
            $table->string('object');
            $table->bigInteger('nm_id');
            $table->bigInteger('imt_id');
            $table->boolean('is_prohibited')->default(false);
            $table->json('tags')->nullable();
            $table->timestamp('update_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('w_b_products');
    }
};
