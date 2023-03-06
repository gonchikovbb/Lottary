<?php

namespace App\Listeners;

use App\Events\AddingPointsEvent;
use App\Models\LotteryGame;
use App\Models\User;

class AddingPointsExecute
{
    public function handle(AddingPointsEvent $event)
    {
        $matchId = $event->match['id'];

        $winnerId = $event->match['winner_id'];

        $rewardPoints = LotteryGame::query()->find($matchId)['reward_points'];

        $user = User::query()->find($winnerId);

        $user->update(['points' => $rewardPoints + $user['points'],]);
    }
}
