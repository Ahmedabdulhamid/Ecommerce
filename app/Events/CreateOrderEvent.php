<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $admin,$order,$latestNotification;
    public function __construct($admin,$order,$latestNotification)
    {
        $this->admin=$admin;
        $this->order=$order;
        $this->latestNotification=$latestNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        return [
            new PrivateChannel('admin.'.$this->admin->id),
        ];
    }
    public function broadcastWith(): array
    {

         return [
            'order_id'=>$this->order->id,
            'user_name'=>$this->order->f_name.' '.$this->order->l_name,
            'total_price'=>$this->order->total_price,
            'status'=>$this->order->status,
            'message'=>'New Order Created Successfully',
            'latestNotificationId'=>$this->latestNotification->id,
            'created'=>$this->latestNotification->created_at->diffForHumans()


        ];
    }
}
