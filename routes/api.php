<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//controllers
use App\Http\Controllers\{AuthController,
    FriendController,
    MatchController,
    GameRoomController,
    LeaderboardController,
    StoreController,
    DiamondController,
    PlayerController,
    ChatController,
    VoiceController,
    AdminController,
    LeagueController};

/**
 * init the broadcasting routes
 */

Route::prefix('auth')->group(function () {
    Route::post('/social', [AuthController::class, 'socialLogin']); // Facebook/Google Login
    Route::post('/guest', [AuthController::class, 'guestLogin']); // Guest Login
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'getProfile']);
        Route::put('/profile/update', [AuthController::class, 'updateProfile']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    /** Friends & Matchmaking */
    Route::prefix('friends')->group(function () {
        Route::post('/request/{playerId}', [FriendController::class, 'sendRequest']);
        Route::post('/accept/{playerId}', [FriendController::class, 'acceptRequest']);
        Route::post('/remove/{playerId}', [FriendController::class, 'removeFriend']);
        Route::get('/list', [FriendController::class, 'listFriends']);
        Route::get('/online', [FriendController::class, 'onlineFriends']);  
    });

    Route::prefix('match')->group(function () {
        Route::post('/invite/{playerId}', [MatchController::class, 'inviteFriend']);
        Route::post('/respond', [MatchController::class, 'respondToInvite']);
    });

    /** League System */
    Route::prefix('leagues')->group(function () {
        Route::post('/create', [LeagueController::class, 'create']); // Create a new league
        Route::get('/list', [LeagueController::class, 'listLeagues']); // Get list of leagues
        Route::get('/{leagueId}', [LeagueController::class, 'getDetails']); // Get details of a specific league
        Route::post('/join/{leagueId}', [LeagueController::class, 'joinLeague']); // Join a league
        Route::post('/leave/{leagueId}', [LeagueController::class, 'leaveLeague']); // Leave a league
        Route::get('/standings/{leagueId}', [LeagueController::class, 'getStandings']); // Get league standings
    });

    /** Game Room & Match Handling */
    Route::prefix('rooms')->group(function () {
        Route::post('/create', [GameRoomController::class, 'create']);
        Route::post('/join/{roomId}', [GameRoomController::class, 'join']);
        Route::post('/leave/{roomId}', [GameRoomController::class, 'leave']);
        Route::get('/{roomId}', [GameRoomController::class, 'getDetails']);
        Route::post('/start/{roomId}', [GameRoomController::class, 'startMatch']);
        Route::post('/end/{roomId}', [GameRoomController::class, 'endMatch']);
        Route::get('/list', [GameRoomController::class, 'listRooms']);
    });

    /** Leaderboard System */
    Route::prefix('leaderboard')->group(function () {
        Route::get('/global', [LeaderboardController::class, 'globalScores']);
        Route::get('/seeks', [LeaderboardController::class, 'seeksTable']);
        Route::get('/league/{leagueId}', [LeaderboardController::class, 'leagueStandings']);
    });

    /** Store & Diamonds */
    Route::prefix('store')->group(function () {
        Route::get('/items', [StoreController::class, 'getItems']);
        Route::post('/buy', [StoreController::class, 'buyItem']);
        Route::get('/inventory', [StoreController::class, 'getInventory']);
    });
    
    Route::prefix('diamonds')->group(function () {
        Route::get('/prices', [DiamondController::class, 'getPrices']);
        Route::post('/buy', [DiamondController::class, 'buyDiamonds']);
        Route::get('/balance', [DiamondController::class, 'getBalance']);
    });

    /** Player Online Status */
    Route::post('/heartbeat', [PlayerController::class, 'sendHeartbeat']);
    Route::get('/players/online', [PlayerController::class, 'getOnlinePlayers']);

    /** Chat System */
    Route::prefix('chat')->group(function () {
        Route::prefix('private')->group(function () {
            Route::post('/send/{receiverId}', [ChatController::class, 'sendPrivateMessage']);
            Route::get('/{playerId}', [ChatController::class, 'getPrivateChat']);
            Route::get('/list', [ChatController::class, 'listPrivateChats']);
        });

        Route::prefix('group')->group(function () {
            Route::post('/create', [ChatController::class, 'createGroup']);
            Route::post('/join/{groupId}', [ChatController::class, 'joinGroup']);
            Route::post('/leave/{groupId}', [ChatController::class, 'leaveGroup']);
            Route::post('/send/{groupId}', [ChatController::class, 'sendGroupMessage']);
            Route::get('/{groupId}', [ChatController::class, 'getGroupMessages']);
        });

        Route::prefix('game')->group(function () {
            Route::post('/send/{roomId}', [ChatController::class, 'sendGameMessage']);
            Route::get('/{roomId}', [ChatController::class, 'getGameMessages']);
        });

        Route::prefix('global')->group(function () {
            Route::post('/send', [ChatController::class, 'sendGlobalMessage']);
            Route::get('/', [ChatController::class, 'getGlobalMessages']);
        });
    });

    /** Voice Chat */
    Route::prefix('voice')->group(function () {
        Route::post('/start/{roomId}', [VoiceController::class, 'startVoiceChat']);
        Route::post('/mute/{playerId}', [VoiceController::class, 'mutePlayer']);
        Route::post('/unmute/{playerId}', [VoiceController::class, 'unmutePlayer']);
        Route::post('/leave/{roomId}', [VoiceController::class, 'leaveVoiceChat']);
        Route::post('/end/{roomId}', [VoiceController::class, 'endVoiceChat']);
    });

    /** Admin Routes */
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::post('/ban/{userId}', [AdminController::class, 'banUser']);
        Route::post('/unban/{userId}', [AdminController::class, 'unbanUser']);
        Route::delete('/chat/message/{messageId}', [AdminController::class, 'deleteChatMessage']);
        Route::post('/chat/ban/{playerId}', [AdminController::class, 'banFromChat']);
        Route::get('/reports', [AdminController::class, 'getReports']);
    });
});
