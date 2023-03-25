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
        Schema::create('farmer_diseases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farmer_id')->unsigned();
            $table->bigInteger('disease_id')->unsigned();
            $table->timestamps();
            $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_diseases');
    }
};
