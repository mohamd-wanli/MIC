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
        Schema::create('stucourse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedBigInteger('Student_id');
            $table->foreign('Student_id')->references('id')->on('students');
            $table->integer('grade')->nullable();
            $table->string('coursegrade')->nullable();
            $table->string('result')->nullable();
            $table->integer('page_number')->nullable();
            $table->integer('general_number')->nullable();
            $table->integer('input_date')->nullable();
            $table->integer('course_number')->nullable();
            $table->integer('hyperlink_number')->nullable();
            $table->integer('certificate_number')->nullable();
            $table->string('sale');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stucourse');
    }
};
