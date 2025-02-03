<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id', 
        'team2_id', 
        'type', 
        'is_active', 
        'min_level_to_join', 
        'chat_allowed', 
        'rounds', 
        'winner', 
        'is_three_pass_seek', 
        'is_seek', 
        'link', 
        'viewers'
    ];

    // Relationships
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }
}
