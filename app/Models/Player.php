<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'profile_pic', 
        'social_login_provider', 
        'social_login_token', 
        'type', 
        'level', 
        'rank', 
        'coins', 
        'group', 
        'current_team', 
        'status', 
        'badges', 
        'friends', 
        'is_online', 
        'assets'
    ];

    // Relationships
    public function group()
    {
        return $this->belongsTo(Team::class, 'group');
    }

    public function currentTeam()
    {
        return $this->belongsTo(Team::class, 'current_team');
    }

    public function chats()
    {
        return $this->hasManyThrough(Chat::class, Message::class, 'sender', 'id', 'id', 'chat_id');
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'player_assets', 'player_id', 'asset_id');
    }

    public function friends()
    {
        // Assuming 'friends' is stored as JSON
        return json_decode($this->friends, true);
    }
    // THE USER IS EQUAL OR GREATER  THEAN THE CURRENT CREDDITE
}
 