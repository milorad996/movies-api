<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTrade implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    

    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    
    public function __construct($data)
    {
        $this->message = $data;
        echo "<p>GetRequestEvent('$data') object has been created.</p>";
    }

    public function broadcastWith(){
         return[
            'it' => 'works'
         ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
    return new Channel('EventTriggered');
    }
}
