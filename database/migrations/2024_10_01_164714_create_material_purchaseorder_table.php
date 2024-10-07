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
        if (! Schema::hasTable('material_purchaseorders')) {
            Schema::create('material_purchaseorder', function (Blueprint $table) {
                $table->id();
                $table->foreignId('material_id')->constrained();
                $table->foreignId('purchaseorder_id')->constrained();
                $table->float('price', 8, 2);
                $table->integer('quantity');
                $table->float('subtotal', 8, 2);
                $table->float('total', 8, 2);
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
        Schema::dropIfExists('material_order');
    }
};
