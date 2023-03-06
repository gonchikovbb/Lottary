<?php

namespace App\Events;

use App\Models\LotteryGameMatchUser;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public LotteryGameMatchUser $lotteryGameMatchUser;

    public function __construct(LotteryGameMatchUser $lotteryGameMatchUser)
    {
        $this->lotteryGameMatchUser = $lotteryGameMatchUser;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
