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
        Schema::create('exam_days', function (Blueprint $table) {
            $table->id();
            $table->string('day_of_session')->nullable();
            $table->string('type_of_examday')->nullable();
            $table->date('session_scheduled_date')->nullable();
            $table->date('session_request_date')->nullable();
            $table->integer('number_of_sessions')->nullable();
            $table->time('session_time')->nullable();
            $table->string('Status', 50);
            $table->integer('Value_Status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_days');
    }
};
