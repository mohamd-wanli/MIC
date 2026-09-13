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
        Schema::create('student_icdl', function (Blueprint $table) {
        
            $table->integer('skill_no')->nullable();
            $table->string('employment')->nullable();
            $table->integer('test_language')->nullable();
            $table->string('image')->nullable();
            $table->integer('password')->nullable();
            $table->integer('version')->nullable();
            $table->string('croups')->nullable();
            $table->integer('exam_fee')->nullable();
            $table->integer('course_number')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_icdl');
    }
};
