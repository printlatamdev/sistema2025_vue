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
        if (! Schema::hasTable('materials')) {
            Schema::create('materials', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('quantity');
                $table->string('serie')->nullable();
                $table->string('ounce')->nullable();
                $table->string('thickness')->nullable();
                $table->float('width')->nullable();
                $table->float('lenght')->nullable();
                $table->string('finish')->nullable();
                $table->float('density')->nullable();
                $table->string('size')->nullable();
                $table->string('gum')->nullable();
                $table->string('print')->nullable();
                $table->string('status')->nullable();
                $table->string('code')->nullable();
                $table->date('entry_date')->nullable();
                $table->date('departure_date')->nullable();
                $table->date('use_date')->nullable();
                $table->date('expiration_date')->nullable();
                $table->foreignId('color_id')->nullable()->constrained();
                $table->foreignId('brand_id')->nullable()->constrained();
                //$table->foreignId('materialcategory_id')->constrained();
                $table->foreignId('materialtype_id')->constrained();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
