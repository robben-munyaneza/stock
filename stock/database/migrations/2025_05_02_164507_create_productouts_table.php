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
        Schema::create('productouts', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('pcode');
            $table->foreign('pcode')->references('pcode')->on('products')->onDelete('cascade');
            $table->foreignId('productin_id')->constrained()->onDelete('cascade');
            $table->date('productout_date');
            $table->integer('productout_quantity');
            $table->decimal('productout_unitprice', 10, 2);
            $table->decimal('productout_totalprice',10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productouts');
    }
};
