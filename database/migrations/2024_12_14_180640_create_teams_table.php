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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::create('teams', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('league_id')->constrained('leagues')->onDelete('cascade'); // Foreign key to Leagues table
            $table->enum('type', ['league', 'group', 'private', 'random']); // Team type
            $table->foreignId('player1_id')->nullable()->constrained('players')->onDelete('set null'); // Foreign key to Players table
            $table->foreignId('player2_id')->nullable()->constrained('players')->onDelete('set null'); // Foreign key to Players table
            $table->integer('score')->default(0); // Total score
            $table->integer('rank')->nullable(); // Rank of the team
            $table->integer('level')->default(1); // Team level
            $table->integer('wins')->default(0); // Wins count
            $table->integer('loses')->default(0); // Losses count
            $table->integer('draws')->default(0); // Draws count
            $table->boolean('is_active')->default(true); // Team's active status
            $table->integer('matches')->default(0); // Number of matches played
            $table->string('name'); // Team name
            $table->json('badges')->nullable(); // Badges earned
            $table->integer('seeks_took')->default(0); // Number of seeks taken
            $table->integer('seeks_gained')->default(0); // Number of seeks gained
            $table->timestamps(); // Created at and Updated at timestamps
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
