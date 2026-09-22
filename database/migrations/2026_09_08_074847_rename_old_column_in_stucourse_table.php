<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


    Schema::table('stucourse', function (Blueprint $table) {
        $table->dropForeign('stucourse_Student_id');
    });

    Schema::table('stucourse', function (Blueprint $table) {
        $table->renameColumn('Student_id', 'student_id');
    });

         Schema::table('stucourse', function (Blueprint $table) {
        $table->foreign('student_id')
              ->references('id')
              ->on('students');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('stucourse', function (Blueprint $table) {
        $table->dropForeign(['student_id']);
        $table->renameColumn('student_id', 'Student_id');
        $table->foreign('Student_id')->references('id')->on('students');
    });

    }
};
