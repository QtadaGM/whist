<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'league_id', 
        'type', 
        'player1_id', 
        'player2_id', 
        'score', 
        'rank', 
        'level', 
        'wins', 
        'loses', 
        'draws', 
        'is_active', 
        'matches', 
        'name', 
        'badges', 
        'seeks_took', 
        'seeks_gained'
    ];

    // Relationships
    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function player1()
    {
        return $this->belongsTo(Player::class, 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo(Player::class, 'player2_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
