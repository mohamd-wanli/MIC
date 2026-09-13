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
              $table->string('year_number')->nullable()->after('page_number');
            $table->string('serial_number')->nullable()->after('year_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stucourse', function (Blueprint $table) {
   $table->dropColumn(['year_number', 'serial_number']);
        });

    }
};
