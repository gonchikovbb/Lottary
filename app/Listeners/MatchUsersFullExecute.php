<?php

namespace App\Listeners;

use App\Events\MatchUserEvent;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\LotteryGameMatchUser;

class MatchUsersFullExecute
{
    public function handle(MatchUserEvent $event)
    {
        $matchId = $event->LotteryGameMatchUser['lottery_game_match_id'];

        $match =  LotteryGameMatch::query()->find($matchId);

        $gameId = $match['game_id'];

        $game = LotteryGame::query()->find($gameId);

        $gamerCount = $game['gamer_count'];

        $countMatches= LotteryGameMatchUser::query()
            ->where('lottery_game_match_id', '=', $matchId)
            ->count();

        if ($countMatches >= $gamerCount) {
            return false;
        }
    }
}
