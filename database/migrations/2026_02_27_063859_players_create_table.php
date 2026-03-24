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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->string(column: 'team')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('full_name');
            $table->string('birthday')->nullable();
            $table->string('college')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('position')->nullable();
            $table->string('jersey_number')->nullable();
            $table->integer('draft_year')->nullable();
            $table->integer('draft_round')->nullable();
            $table->integer('draft_number')->nullable();
            $table->string('country')->nullable();
            $table->string('gp')->nullable();
            $table->string('min')->nullable();
            $table->decimal('ppg', 5, 2)->nullable();
            $table->decimal('rpg', 5, 2)->nullable();
            $table->decimal('apg', 5, 2)->nullable();
            $table->decimal('spg', 5, 2)->nullable();
            $table->decimal('bpg', 5, 2)->nullable();
            $table->decimal('tpg', 5, 2)->nullable();
            $table->decimal('fgm', 5, 2)->nullable();
            $table->decimal('fga', 5, 2)->nullable();
            $table->decimal('fg_prc', 5, 2)->nullable();
            $table->decimal('three_pm', 5, 2)->nullable();
            $table->decimal('three_pa', 5, 2)->nullable();
            $table->decimal('three_prc', 5, 2)->nullable();
            $table->decimal('ftm', 5, 2)->nullable();
            $table->decimal('fta', 5, 2)->nullable();
            $table->decimal('ft_prc', 5, 2)->nullable();
            $table->decimal('oreb', 5, 2)->nullable();
            $table->decimal('dreb', 5, 2)->nullable();
            $table->decimal('pf', 5, 2)->nullable();
            $table->integer('dd2')->nullable();
            $table->integer('td3')->nullable();
            $table->decimal('plus_minus', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
