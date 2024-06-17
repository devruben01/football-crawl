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
        Schema::create('fixture', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fixture_id');
            $table->string('fixture_time');
            $table->unsignedInteger('season_id');
            $table->unsignedInteger('round_id');
            $table->unsignedInteger('away_team_id');
            $table->unsignedInteger('home_team_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixture');
    }
};
