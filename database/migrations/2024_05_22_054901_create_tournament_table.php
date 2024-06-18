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
        Schema::create('tournament', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tournament_id');
            $table->string('tournament_name');
            $table->string('tournament_en_name');
            $table->string('tournament_url_name');
            $table->string('logo_url')->nullable();
            $table->unsignedInteger('category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('round');
    }
};
