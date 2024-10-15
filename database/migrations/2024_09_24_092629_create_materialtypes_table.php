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
        if (! Schema::hasTable('materialtypes')) {
            Schema::create('materialtypes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->foreignId('materialcategory_id')->constrained();
                $table->integer('status')->default(1);
                $table->foreignId('color_id')->nullable()->constrained();
                $table->integer('quantity')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materialtypes');
    }
};
