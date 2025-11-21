<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $name,$response;

    /**
     * Create a new notification instance.
     */
    public function __construct($contact,$response)
    {
        $this->name=$contact['name'];
        $this->response=$response;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Hello'.' '. $this->name)
                    ->line('Our Response'.' '.$this->response)
                    ->line('Thank you for using our application!');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
