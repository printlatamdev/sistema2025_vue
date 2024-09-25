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
        if(!Schema::hasTable('orders')){
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained();
                $table->foreignId('contact_id')->constrained();
                $table->date('delivery_date');
                $table->foreignId('user_id')->constrained();
                $table->integer('status')->default(0);
                $table->integer('computo')->default(0);
                $table->integer('print')->default(0);
                $table->integer('cut')->default(0);
                $table->foreignId('country_id')->constrained();
                $table->float('payment', 8, 2);
                $table->float('mod', 8, 2);
                $table->foreignId('project_id')->constrained();
                $table->string('application_number')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
