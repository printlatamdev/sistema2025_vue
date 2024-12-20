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
        if (! Schema::hasTable('purchaseorders')) {
            Schema::create('purchaseorders', function (Blueprint $table) {
                $table->id();
                $table->string('ordertype')->nullable();
                $table->text('details')->nullable();
                $table->foreignId('provider_id')->constrained();
                $table->float('total', 8, 2)->nullable();
                $table->string('approvedBy')->nullable();
                $table->string('requestedBy')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
