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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('child_name');
            $table->integer('age'); // Age column to store the child's age
            $table->string('class_name'); // Class ID column to store the associated class ID
            $table->string('course_name');
            $table->string('grade');
            $table->text('teachers_remarks')->nullable();
            // Add other report-related columns as needed
            $table->timestamps();
    
            // Add foreign key constraint for class_id column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
