<?php

namespace App\Listeners;

use App\Events\MatchUserEvent;
use App\Models\LotteryGameMatchUser;
use Illuminate\Support\Facades\DB;

class MatchUserExecute
{
    public function handle(MatchUserEvent $event)
    {
        $userId = $event->lotteryGameMatchUser->getUserId();

        $lotteryGameMatchId = $event->lotteryGameMatchUser->getLotteryGameMatchId();

        $record = DB::table('lottery_game_match_users')->where([
            ['user_id','=', $userId],
            ['lottery_game_match_id','=', $lotteryGameMatchId],
        ])->first();

        if (!empty($record)) {
            return false;
        }
    }
}
