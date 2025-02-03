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
        Schema::create('players', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Player's name
            $table->string('profile_pic')->nullable(); // URL to profile picture
            $table->enum('social_login_provider', ['google', 'facebook', 'twitter'])->nullable(); // Social login provider
            $table->string('social_login_token')->nullable(); // Token for social login
            $table->enum('type', ['guest', 'user'])->default('guest'); // Whether the player is a guest or registered user
            $table->integer('level')->default(1); // Player's in-game level
            $table->integer('rank')->default(0); // Player's rank
            $table->bigInteger('coins')->default(0); // Coins owned by the player
            $table->foreignId('group')->nullable()->constrained('teams')->onDelete('set null'); // Current group/team (nullable)
            $table->foreignId('current_team')->nullable()->constrained('teams')->onDelete('set null'); // Current team (nullable)
            $table->enum('status', ['active', 'banned', 'inactive'])->default('active'); // Player's status
            $table->json('badges')->nullable(); // List of badges owned by the player
            $table->json('friends')->nullable(); // List of friends (as JSON)
            $table->boolean('is_online')->default(false); // Online/offline status
            $table->json('assets')->nullable(); // JSON for assets owned
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
