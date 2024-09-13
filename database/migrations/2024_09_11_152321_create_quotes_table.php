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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('payment_condition')->nullable(); //enum
            $table->string('offer_validity')->nullable(); //enum
            $table->string('currency')->nullable(); //enum
            $table->string('incoterm')->nullable(); //enum
            $table->string('status'); //enum
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('contact_id')->constrained();
            $table->text('important_note')->nullable();
            //morph image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
