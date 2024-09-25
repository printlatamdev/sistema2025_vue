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
            $table->string('brand');
            $table->string('serie');
            $table->string('ounce');
            $table->string('thickness');
            $table->float('width');
            $table->float('lenght');
            $table->string('color');
            $table->string('finish');
            $table->float('density');
            $table->string('size');
            $table->string('gum');
            $table->string('print');
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
