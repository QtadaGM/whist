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
        Schema::create('games', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('team1_id')->constrained('teams')->onDelete('cascade'); // Foreign key to Teams (team 1)
            $table->foreignId('team2_id')->constrained('teams')->onDelete('cascade'); // Foreign key to Teams (team 2)
            $table->enum('type', ['league', 'group', 'private', 'random']); // Type of the game
            $table->boolean('is_active')->default(true); // Whether the game is active
            $table->integer('min_level_to_join')->default(1); // Minimum level to join
            $table->boolean('chat_allowed')->default(true); // Whether chat is allowed
            $table->integer('rounds')->default(0); // Total rounds in the game
            $table->foreignId('winner')->nullable()->constrained('teams')->onDelete('set null'); // Winning team (nullable)
            $table->boolean('is_three_pass_seek')->default(false); // Whether 3-pass seek rule applies
            $table->boolean('is_seek')->default(false); // Whether it’s a seek game
            $table->string('link')->nullable(); // Link to game session
            $table->integer('viewers')->default(0); // Number of viewers
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
