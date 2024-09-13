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
        Schema::create('quotedetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->nullable()->constrained();
            $table->foreignId('quotedetail_id')->nullable()->constrained();
            $table->float('price', 8, 2)->default(0);
            $table->integer('quantity');
            $table->float('total')->default(0);
            $table->longText('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotedetails');
    }
};
