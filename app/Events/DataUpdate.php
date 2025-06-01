<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DataUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;
    /**
     * Create a new event instance.
     */
    public function __construct($table = '')
    {
        $this->table = $table;
        
        

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {

        return new Channel('data-refresh');
        
    }
    
    public function broadcastAs()
    {
        return $this->table;
        
    }
}
