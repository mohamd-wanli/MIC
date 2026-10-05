<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Nothing to do if the column is already lowercase
        if (! Schema::hasColumn('stucourse', 'Student_id')) {
            return;
        }

        // Drop the FK if it exists (try both common naming patterns)
        $this->dropForeignKeyIfExists('stucourse', 'stucourse_Student_id_foreign');
        $this->dropForeignKeyIfExists('stucourse', 'stucourse_student_id_foreign');

        Schema::table('stucourse', function (Blueprint $table) {
            $table->renameColumn('Student_id', 'student_id');
        });

        Schema::table('stucourse', function (Blueprint $table) {
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('stucourse', 'student_id')) {
            return;
        }

        $this->dropForeignKeyIfExists('stucourse', 'stucourse_student_id_foreign');
        $this->dropForeignKeyIfExists('stucourse', 'stucourse_Student_id_foreign');

        Schema::table('stucourse', function (Blueprint $table) {
            $table->renameColumn('student_id', 'Student_id');
        });

        Schema::table('stucourse', function (Blueprint $table) {
            $table->foreign('Student_id')
                  ->references('id')
                  ->on('students');
        });
    }

    /**
     * Drop a foreign key only if it exists. Wrapped in try/catch so we
     * don't break on MySQL/MariaDB quirks in information_schema.
     */
    private function dropForeignKeyIfExists(string $table, string $fkName): void
    {
        try {
            Schema::table($table, function (Blueprint $t) use ($fkName) {
                $t->dropForeign($fkName);
            });
        } catch (\Throwable $e) {
            // FK doesn't exist — safe to ignore
        }
    }
};
