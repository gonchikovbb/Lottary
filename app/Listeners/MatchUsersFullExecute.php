<?php

namespace App\Listeners;

use App\Events\MatchUsersFullEvent;
use App\Models\LotteryGameMatchUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MatchUsersFullExecute
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MatchUsersFullEvent  $event
     * @return void
     */
    public function handle(MatchUsersFullEvent $event)
    {
        $maxUsers = 3;

        $countMatches= LotteryGameMatchUser::query()->where('lottery_game_match_id', '=', $event->lotteryGameMatchId)->count();

        if ($countMatches >= $maxUsers) {
            print_r( 'Full players finished!');
            exit;
        }
    }
}
