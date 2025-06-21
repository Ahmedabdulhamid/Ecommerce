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

class CreateContactEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $contact,$admin,$latestNotification;
    public function __construct($contact,$admin,$latestNotification)
    {
        $this->contact=$contact;
        $this->admin=$admin;
        $this->latestNotification=$latestNotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
       Log::info('contact Created', [
    'contact' => $this->contact->id,
    'admin' => $this->admin->id
]);
        return [
            new PrivateChannel('contact.'.$this->admin->id),
        ];
    }
    public function broadcastWith():array
    {
       Log::info('contact Created', [
    'contact' => $this->contact->id,
    'admin' => $this->admin->id
]);
        return [
            'email'=>$this->contact->email,
            'message'=>$this->contact->message,
            'custom_message'=>'New Contact Created',
            'name'=>$this->contact->name,
            'subject'=>$this->contact->subject,
            'latestNotificationId'=>$this->latestNotification->id,
            'created'=>$this->latestNotification->created_at->diffForHumans()

        ];
    }
}
