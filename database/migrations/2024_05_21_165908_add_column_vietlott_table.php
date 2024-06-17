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
        Schema::table('vietlott', function (Blueprint $table) {
            $table->json('prize_value')->after('type');
            $table->json('quantity')->after('prize_value');
            $table->string('ticket_period')->after('quantity');
            $table->boolean('run')->after('result')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vietlott', function (Blueprint $table) {
            $table->dropColumn('prize_value');
            $table->dropColumn('quantity');
            $table->dropColumn('ticket_period');
            $table->dropColumn('run');
        });
    }
};
