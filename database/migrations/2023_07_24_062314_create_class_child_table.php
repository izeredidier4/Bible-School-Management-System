<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('class_child', function (Blueprint $table) {
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('child_id');
            
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');

            // Add any other fields you may need for the pivot table here.

            // Make the combination of class_id and child_id unique to prevent duplicates.
            //$table->unique(['class_id', 'child_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_child');
    }
};
