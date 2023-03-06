<?php

namespace App\Listeners;

use App\Events\MatchWinnerEvent;
use App\Models\LotteryGameMatchUser;

class MatchWinnerExecute
{
    public function handle(MatchWinnerEvent $event)
    {
        $matchId = $event->match->getMatchId();

        $usersRecord = LotteryGameMatchUser::query()->where('lottery_game_match_id', '=', $matchId)->get();

        foreach ($usersRecord as $record) {
            $userIds[] = $record->getUserId();
        }
        $winnerIdKey = array_rand($userIds,1);

        $winnerId = $userIds[$winnerIdKey];

        $event->match['winner_id'] = $winnerId;
    }
}
