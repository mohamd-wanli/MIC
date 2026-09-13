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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions_number');
            $table->unsignedBigInteger('Student_id');
            $table->foreign('Student_id')->references('id')->on('students');
            $table->string('course_name');
            $table->string('session_name')->nullable();
            $table->string('student_name');
            $table->integer('payment_amount');
            $table->date('payment_date');
            $table->integer('invoice_num');
            $table->string('payment_type');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
