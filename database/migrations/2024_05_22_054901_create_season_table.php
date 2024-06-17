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
        Schema::create('season', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('season_id');
            $table->datetime('season_start');
            $table->datetime('season_end');
            $table->string('season_year');
            $table->unsignedInteger('tournament_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season');
    }
};
