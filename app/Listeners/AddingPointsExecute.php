<?php

namespace App\Listeners;

use App\Events\AddingPointsEvent;
use App\Models\LotteryGame;
use App\Models\User;

class AddingPointsExecute
{
    public function handle(AddingPointsEvent $event)
    {
        $gameId = $event->match->getGameId();

        $winnerId = $event->match->getWinnerId();

        $rewardPoints = LotteryGame::query()->find($gameId)['reward_points'];

        $user = User::query()->find($winnerId);

        $user->update(['points' => $rewardPoints + $user['points'],]);
    }
}
