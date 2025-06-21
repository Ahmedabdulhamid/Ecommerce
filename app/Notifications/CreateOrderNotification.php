<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $order;
    public function __construct($order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
      public function toArray(object $notifiable): array
    {
        return [
            'order_id'=>$this->order->id,
            'user_name'=>$this->order->f_name.' '.$this->order->l_name,
            'total_price'=>$this->order->total_price,
            'status'=>$this->order->status,
            'message'=>'New Order Created Successfully',
            'created' => $this->order->created_at->diffForHumans()


        ];
    }
    public function databaseType(object $notifiable):string
    {
      return 'CreateOrderNotification';
    }
}
