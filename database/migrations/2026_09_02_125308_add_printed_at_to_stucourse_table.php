<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::table('stucourse', function (Blueprint $table) {
            $table->timestamp('printed_at')->nullable()->after('serial_number');
        });
    }

    public function down()
    {
        Schema::table('stucourse', function (Blueprint $table) {
            $table->dropColumn('printed_at');
        });
    }
};
