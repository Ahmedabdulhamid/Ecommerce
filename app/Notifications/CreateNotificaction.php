<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PhpParser\Node\Scalar\MagicConst\Function_;

class CreateNotificaction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $contact;
    public function __construct($cotact)
    {
        $this->contact=$cotact;
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
            'email'=>$this->contact->email,
            'message'=>$this->contact->message,
            'custom_message'=>'New Contact Created',
            'name'=>$this->contact->name,
            'subject'=>$this->contact->subject,
        ];
    }
    public Function databaseType(object $notifiable):string
    {
      return 'CreateContactNotification';
    }
}
