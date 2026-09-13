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
        Schema::create('extra_student', function (Blueprint $table) {

            $table->string('engish_firstname')->nullable();
            $table->string('engish_fathername')->nullable();
            $table->string('english_lastname')->nullable();
            $table->string('grandfathername')->nullable();
            $table->string('english_grandfathername')->nullable();
            $table->string('mothername')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->date('print_date')->nullable();
            $table->string('email')->nullable();
            $table->integer('telephone')->nullable();
            $table->integer('mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('nationality')->nullable();
            $table->string('cultural_level')->nullable();
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
        Schema::dropIfExists('extra_student');
    }
};
