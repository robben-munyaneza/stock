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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userId');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('product', function (Blueprint $table) {
         $table->id('productId');
         $table->string('pname');
         $table->timestamps();

        });

        // Schema::create('product_in', function (Blueprint $table) {
        //  $table->id('product_inId');
        //  $table->unsignedBigInteger('productId');
        //  $table->
        // });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('products');
    }
};
