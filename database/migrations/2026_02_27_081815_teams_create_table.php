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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('name')->unique();
            $table->string('logo_url')->nullable();
            $table->string('division')->nullable();
            $table->string('conference')->nullable();
            $table->string('city')->nullable();
            $table->string('arena')->nullable();
            $table->string('head_coach')->nullable();
            $table->string('lead_assistant_coach')->nullable();
            $table->text('assistant_coach')->nullable();
            $table->string('trainer')->nullable();
            $table->string('trainer_assistant')->nullable();
            $table->string('coach_development')->nullable();
            $table->integer('founded')->nullable();
            $table->integer('championships')->nullable();
            $table->integer('gp')->nullable();
            $table->integer('w')->nullable();
            $table->integer('l')->nullable();
            $table->decimal('w_pct', 6, 3)->nullable();
            $table->decimal('min', 6, 2)->nullable();
            $table->decimal('pts', 6, 2)->nullable();
            $table->decimal('fgm', 6, 2)->nullable();
            $table->decimal('fga', 6, 2)->nullable();
            $table->decimal('fg_pct', 6, 3)->nullable();
            $table->decimal('fg3m', 6, 2)->nullable();
            $table->decimal('fg3a', 6, 2)->nullable();
            $table->decimal('fg3_pct', 6, 3)->nullable();
            $table->decimal('ftm', 6, 2)->nullable();
            $table->decimal('fta', 6, 2)->nullable();
            $table->decimal('ft_pct', 6, 3)->nullable();
            $table->decimal('oreb', 6, 2)->nullable();
            $table->decimal('dreb', 6, 2)->nullable();
            $table->decimal('reb', 6, 2)->nullable();
            $table->decimal('ast', 6, 2)->nullable();
            $table->decimal('tov', 6, 2)->nullable();
            $table->decimal('stl', 6, 2)->nullable();
            $table->decimal('blk', 6, 2)->nullable();
            $table->decimal('blka', 6, 2)->nullable();
            $table->decimal('pf_team', 6, 2)->nullable();
            $table->decimal('pfd', 6, 2)->nullable();
            $table->decimal('plus_minus', 6, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
