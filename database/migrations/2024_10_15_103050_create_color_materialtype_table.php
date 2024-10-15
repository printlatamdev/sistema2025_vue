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
        Schema::create('color_materialtype', function (Blueprint $table) {
            $table->id();
            $table->foreignId('color_id')->constrained();
            $table->foreignId('materialtype_id')->constrained();
            $table->string('code');
            $table->date('entry_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('use_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('color_materialtype');
    }
};
