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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade'); // Foreign key to Chats table
            $table->enum('type', ['text', 'media']); // Type of message
            $table->foreignId('sender')->constrained('players')->onDelete('cascade'); // Foreign key to Players table (sender)
            $table->boolean('red_flagged')->default(false); // If the message is flagged
            $table->boolean('is_seen')->default(false); // If the message is seen
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
