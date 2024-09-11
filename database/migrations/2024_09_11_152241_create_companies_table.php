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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('social_reason');
            $table->string('commercial_name');
            $table->text('address');
            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();
            $table->string('nrc')->nullable();
            $table->string('business_line')->nullable();
            $table->string('nit')->nullable();
            $table->string('agency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
