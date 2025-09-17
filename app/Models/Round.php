<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'game_id', 
        'trump', 
        'team1_hands', 
        'team2_hands', 
        'naming', 
        'chat_id', 
        'chat_allowed', 
        'is_active'
    ];

    // Relationships
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
