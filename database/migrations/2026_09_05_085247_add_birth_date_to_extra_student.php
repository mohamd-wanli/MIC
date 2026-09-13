<?php

use Carbon\Carbon;
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
      // 1. Add a new date column
        Schema::table('extra_student', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('date_of_birth');
        });

        // 2. Extract dates from the existing string column
        $students = DB::table('extra_student')->get();

        foreach ($students as $student) {
            if (empty($student->date_of_birth)) {
                continue;
            }

            $raw = $student->date_of_birth;
            $cleanDate = null;

            // Try to find a date pattern (d-m-Y, d/m/Y, etc.)
            preg_match('/(\d{1,2}[\/\-]\d{1,2}[\/\-]\d{2,4})/', $raw, $matches);
            $dateStr = $matches[1] ?? null;

            if ($dateStr) {
                // Attempt to parse
                try {
                    $cleanDate = Carbon::createFromFormat('d-m-Y', $dateStr)->format('Y-m-d');
                } catch (\Exception $e) {
                    try {
                        $cleanDate = Carbon::createFromFormat('d/m/Y', $dateStr)->format('Y-m-d');
                    } catch (\Exception $e2) {
                        // Try generic parse
                        try {
                            $cleanDate = Carbon::parse($dateStr)->format('Y-m-d');
                        } catch (\Exception $e3) {
                            // Could not parse
                        }
                    }
                }
            } else {
                // No pattern found – try to parse the whole string
                try {
                    $cleanDate = Carbon::parse($raw)->format('Y-m-d');
                } catch (\Exception $e) {
                    // Leave null
                }
            }

            if ($cleanDate) {
                DB::table('extra_student')
                    ->where('student_id', $student->student_id)
                    ->update(['birth_date' => $cleanDate]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('extra_student', function (Blueprint $table) {
            $table->dropColumn('birth_date');
        });
    }
};
