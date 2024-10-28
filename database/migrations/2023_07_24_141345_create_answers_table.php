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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id')->nullable(); // If you want to associate answers with children
            $table->unsignedBigInteger('quiz_id'); // Add the column for referencing the quiz
            $table->unsignedBigInteger('question_id');
            $table->string('user_answer');
            $table->boolean('is_correct')->default(false); // Default value set to false
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
