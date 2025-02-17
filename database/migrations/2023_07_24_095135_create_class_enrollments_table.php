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
            Schema::create('class_enrollments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('class_id');
                $table->unsignedBigInteger('child_id');
                $table->enum('status', ['enrolled', 'pending', 'canceled'])->default('pending');
                $table->timestamps();
    
                $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
                $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            });
        }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_enrollments');
    }
};
