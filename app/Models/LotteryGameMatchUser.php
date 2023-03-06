<?php

namespace App\Models;

use App\Events\MatchUserEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryGameMatchUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lottery_game_match_id',
    ];

    protected $dispatchesEvents = [
        'saving' => MatchUserEvent::class,
    ];
}
