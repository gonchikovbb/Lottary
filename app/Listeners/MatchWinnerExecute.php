<?php

namespace App\Listeners;

use App\Events\MatchWinnerEvent;
use App\Models\LotteryGameMatch;
use App\Models\LotteryGameMatchUser;

class MatchWinnerExecute
{
    public function handle(MatchWinnerEvent $event)
    {
        $matchId = $event->match['id'];

        $usersRecord[]= LotteryGameMatchUser::query()->where('lottery_game_match_id', '=', $matchId)->get();

        foreach ($usersRecord[0] as $record) {
            $users[] = $record['user_id'];
        }
        $winnerIdKey = array_rand($users,1);

        $winnerId = $users[$winnerIdKey];

        $match = LotteryGameMatch::query()->find($matchId);

        $match->update(['winner_id' => $winnerId]);

    }
}
