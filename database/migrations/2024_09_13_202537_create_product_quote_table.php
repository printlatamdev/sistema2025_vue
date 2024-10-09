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
        if (! Schema::hasTable('product_quote')) {
            Schema::create('product_quote', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained();
                $table->foreignId('quote_id')->constrained();
                $table->float('price', 8, 2);
                $table->integer('quantity');
                $table->string('image');
                $table->float('subtotal', 8, 2);
                $table->longText('details')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_quote');
    }
};
