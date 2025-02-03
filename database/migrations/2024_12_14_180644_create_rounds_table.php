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
        Schema::create('rounds', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade'); // Foreign key to Games table
            $table->string('trump')->nullable(); // Trump card for the round (if applicable)
            $table->integer('team1_hands')->default(0); // Hands won by Team 1
            $table->integer('team2_hands')->default(0); // Hands won by Team 2
            $table->enum('naming', [7, 8, 9, 10, 11, 12, 13])->nullable(); // The naming of the round (7-13)
            $table->foreignId('chat_id')->nullable()->constrained('chats')->onDelete('cascade'); // Associated chat
            $table->boolean('chat_allowed')->default(true); // Whether chat is allowed in this round
            $table->boolean('is_active')->default(true); // Whether the round is still active
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
