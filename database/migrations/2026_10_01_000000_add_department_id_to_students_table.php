<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
          // Only add the column if it does not already exist
        if (!Schema::hasColumn('students', 'department_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Only drop it if it actually exists
        if (Schema::hasColumn('students', 'department_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropConstrainedForeignId('department_id');
            });
        }
    }
};
