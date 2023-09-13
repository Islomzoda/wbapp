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
        Schema::create('w_b_s', function (Blueprint $table) {
            $table->id();
            $table->string('brand_id');
            $table->string('name');
            $table->string('fbo_api_key')->nullable();
            $table->string('fbs_api_key')->nullable();
            $table->string('ads_api_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('w_b_s');
    }
};
