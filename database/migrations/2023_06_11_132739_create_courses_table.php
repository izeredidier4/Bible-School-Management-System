<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();  // Creates an unsignedBigInteger 'id'
            $table->string('title');
            $table->string('description');
            $table->timestamp('date')->useCurrent();
        
            // Foreign key to teachers table (matching data types)
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                  ->references('id')->on('teachers')
                  ->onDelete('cascade');
        
            // Foreign key to classes table (matching data types)
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                  ->references('id')->on('classes')
                  ->onDelete('cascade');
        
            $table->timestamps();
        });
        
        
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
