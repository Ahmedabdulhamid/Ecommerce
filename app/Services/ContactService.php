<?php

namespace App\Services;

use App\Events\CreateContactEvent;
use App\Models\Admin;
use App\Notifications\CreateNotificaction;
use App\Repositories\ContactRepository;
use Illuminate\Support\Facades\Notification;

class ContactService
{
    public function __construct(private readonly ContactRepository $contacts)
    {
    }

    public function create(array $data)
    {
        $contact = $this->contacts->create([
            ...$data,
            'is_read' => 0,
            'is_replied' => 0,
        ]);

        $admins = Admin::all();
        Notification::send($admins, new CreateNotificaction($contact));

        foreach ($admins as $admin) {
            $latestNotification = $admin->notifications()->latest()->first();
            broadcast(new CreateContactEvent($contact, $admin, $latestNotification))->toOthers();
        }

        return $contact;
    }
}
