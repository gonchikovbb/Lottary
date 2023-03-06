<?php

namespace App\Events;

use App\Models\LotteryGameMatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddingPointsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public LotteryGameMatch $match;

    public function __construct(LotteryGameMatch $match)
    {
        $this->match = $match;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
