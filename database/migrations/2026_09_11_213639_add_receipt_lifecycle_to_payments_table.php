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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('receipt_number')->nullable()->after('id');
            $table->date('collected_at')->nullable()->after('payment_value');
            $table->timestamp('surrendered_at')->nullable()->after('collected_at');
            $table->unsignedBigInteger('surrendered_to')->nullable()->after('surrendered_at');
            $table->unsignedBigInteger('entered_by')->nullable()->after('surrendered_to');

            $table->index('receipt_number');
            $table->index('collected_at');
            $table->index('surrendered_at');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['receipt_number']);
            $table->dropIndex(['collected_at']);
            $table->dropIndex(['surrendered_at']);
            $table->dropColumn([
                'receipt_number',
                'collected_at',
                'surrendered_at',
                'surrendered_to',
                'entered_by',
            ]);
        });
    }
};
