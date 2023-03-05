<?php

namespace App\Listeners;

use App\Events\MatchUserEvent;
use App\Models\LotteryGameMatchUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class MatchUserExecute
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
     * @param  \App\Events\MatchUserEvent  $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(MatchUserEvent $event)
    {
        $match = DB::table('lottery_game_match_users')->where([
            ['user_id','=', $event->userId],
            ['lottery_game_match_id','=', $event->lotteryGameMatchId],
        ])->get();

        $match = json_decode($match,true);

        if (!empty($match)) {
            print_r( 'You are already signed up for the game!');
            return false;
        }
    }
}
