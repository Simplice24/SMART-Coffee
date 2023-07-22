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
        Schema::create('reported_by_prediction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cooperative_id');
            $table->string('predicted_class');
            $table->decimal('confidence', 16, 15); // Data type to store number like 1.7885768875443
            $table->string('image');
            $table->string('longitude', 30); // Data type for longitude (up to 7 decimal places)
            $table->string('latitude', 30); // Data type for latitude (up to 7 decimal places)
            $table->timestamps();

            // Add foreign key constraint for cooperative_id
            $table->foreign('cooperative_id')
                  ->references('id')
                  ->on('cooperatives')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reported_by_prediction');
    }
};
