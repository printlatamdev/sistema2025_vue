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
        Schema::create('purchaseorder_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchaseorder_id')->nullable()->constrained();
            $table->float('total_materials', 8, 2)->default(0);
            $table->float('iva')->nullable();
            $table->float('total', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchaseorder_details');
    }
};
