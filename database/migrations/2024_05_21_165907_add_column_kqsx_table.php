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
        Schema::table('kqsx', function (Blueprint $table) {
            $table->string('special_symbols')->nullable()->after('region');
            $table->boolean('run')->after('result')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kqsx', function (Blueprint $table) {
            $table->dropColumn('special_symbols');
            $table->dropColumn('run');
        });
    }
};
