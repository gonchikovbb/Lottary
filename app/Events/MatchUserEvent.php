<?php

namespace App\Events;

use App\Models\LotteryGameMatchUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public LotteryGameMatchUser $LotteryGameMatchUser;

    public function __construct(LotteryGameMatchUser $LotteryGameMatchUser)
    {
        $this->LotteryGameMatchUser = $LotteryGameMatchUser;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
