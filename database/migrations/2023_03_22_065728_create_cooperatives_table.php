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
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('manager_name');
            $table->string('category');
            $table->string('email');
            $table->string('status');
            $table->string('starting_date');
            $table->string('province');
            $table->string('district');
            $table->string('sector');
            $table->string('cell');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperatives');
    }
};
