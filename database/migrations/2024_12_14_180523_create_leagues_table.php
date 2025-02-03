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
         Schema::create('leagues', function (Blueprint $table) {
             $table->id(); // Primary key
             $table->string('name'); // Name of the league
             $table->text('about')->nullable(); // About the league
             $table->text('terms')->nullable(); // Terms and conditions
             $table->string('phase')->nullable(); // Current phase of the league
             $table->integer('noOfTeams')->default(0); // Number of teams in the league
             $table->string('lastWinnerTeam')->nullable(); // Last winner team name
             $table->json('prizes')->nullable(); // JSON column for prize details
             $table->timestamps(); // Created at and Updated at timestamps
         });
     }
     
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
