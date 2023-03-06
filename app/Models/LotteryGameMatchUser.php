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

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getLotteryGameMatchId()
    {
        return $this->lottery_game_match_id;
    }
}
