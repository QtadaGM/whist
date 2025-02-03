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
        Schema::create('chats', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->enum('type', ['private', 'group', 'global']); // Type of chat
            $table->boolean('media_messages_allowed')->default(true); // Whether media messages are allowed
            $table->json('participants'); // JSON column to store chat participants
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
