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
        Schema::create('productin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pcode');
            $table->foreign('pcode')->references('pcode')->on('products')->onDelete('cascade');
            $table->date('productin_date');
            $table->integer('productin_quantity');
            $table->decimal('productin_unitprice', 10, 2);
            $table->decimal('productin_totalprice',10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productins');
    }
};
