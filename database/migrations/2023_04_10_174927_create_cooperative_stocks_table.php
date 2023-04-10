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
        Schema::create('cooperative_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('product_category');
            $table->integer('quantity');
            $table->unsignedBigInteger('cooperative_id');
            $table->timestamps();
            $table->foreign('cooperative_id')->references('id')->on('cooperatives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperative_stocks');
    }
};
