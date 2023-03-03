<?php

namespace App\Listeners;

use App\Events\MatchWinnerEvent;
use App\Models\LotteryGame;
use App\Models\LotteryGameMatch;
use App\Models\LotteryGameMatchUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MatchWinnerExecute
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
     * @param  \App\Events\MatchWinnerEvent  $event
     * @return void
     */
    public function handle(MatchWinnerEvent $event)
    {
        $usersRecord[]= json_decode(LotteryGameMatchUser::query()->where('lottery_game_match_id', '=', $event->match['id'])->get(),true);

        foreach ($usersRecord[0] as $record) {
            $users[] = $record['user_id'];
        }
        $winnerIdKey = array_rand($users,1);

        $winnerId = $users[$winnerIdKey];

        $match = LotteryGameMatch::query()->find($event->match['id']);

        $match->update(['winner_id' => $winnerId,]);

        $rewardPoints = json_decode(LotteryGame::query()->find($event->match['id']),true)['reward_points'];

        $user = User::query()->find($winnerId);

        $user->update(['points' => $rewardPoints + $user['points'],]);
    }
}
