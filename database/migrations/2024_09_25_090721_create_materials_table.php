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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serie')->nullable();
            $table->string('ounce')->nullable();
            $table->string('thickness')->nullable();
            $table->float('width')->nullable();
            $table->float('lenght')->nullable();
            $table->string('color')->nullable();
            $table->string('finish')->nullable();
            $table->float('density')->nullable();
            $table->string('size')->nullable();
            $table->string('gum')->nullable();
            $table->string('print')->nullable();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
