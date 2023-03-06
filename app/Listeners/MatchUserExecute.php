<?php

namespace App\Listeners;

use App\Events\MatchUserEvent;
use Illuminate\Support\Facades\DB;

class MatchUserExecute
{
    public function handle(MatchUserEvent $event)
    {
        $userId = $event->LotteryGameMatchUser['user_id'];

        $lotteryGameMatchId = $event->LotteryGameMatchUser['lottery_game_match_id'];

        $record = DB::table('lottery_game_match_users')->where([
            ['user_id','=', $userId],
            ['lottery_game_match_id','=', $lotteryGameMatchId],
        ])->first();

        if (!empty($record)) {
            return false;
        }
    }
}
