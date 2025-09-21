<?php

namespace App\Events;

use App\Models\Jamaah;
use App\Models\Group;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JamaahAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $jamaah;
    public $group;

    /**
     * Create a new event instance.
     */
    public function __construct(Jamaah $jamaah, Group $group)
    {
        $this->jamaah = $jamaah;
        $this->group = $group;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('jamaah-updates'),
        ];
    }
}
