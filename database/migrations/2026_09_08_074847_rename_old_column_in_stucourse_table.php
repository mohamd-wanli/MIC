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
         Schema::table('stucourse', function (Blueprint $table) {
        // 1. Explicitly drop the constraint first
        $table->dropForeign(['Student_id']);

        // 2. Rename the column
        $table->renameColumn('Student_id', 'student_id');

        // 3. Re-add the constraint on the new column name
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
