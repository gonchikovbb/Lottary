<?php

namespace App\Models;

use App\Events\AddingPointsEvent;
use App\Events\MatchWinnerEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryGameMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'start_date',
        'start_time',
        'is_finished',
        'winner_id',
    ];

    protected $dispatchesEvents = [
          'пше ' => MatchWinnerEvent::class,
          'updated' => AddingPointsEvent::class,
    ];

    public function getMatchId()
    {
        return $this->id;
    }

    public function getWinnerId()
    {
        return $this->winner_id;
    }

    public function getGameId()
    {
        return $this->game_id;
    }
}
