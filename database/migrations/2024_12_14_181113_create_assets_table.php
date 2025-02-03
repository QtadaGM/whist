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
        Schema::create('assets', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->enum('type', ['badge', 'trophy', 'skin', 'ability']); // Type of asset
            $table->string('label'); // Name of the asset
            $table->string('media_link')->nullable(); // URL to asset media (e.g., images, animations)
            $table->text('description')->nullable(); // Description of the asset
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
