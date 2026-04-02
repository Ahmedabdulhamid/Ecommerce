<?php

namespace App\Livewire\Front;

use App\Services\ContactService;
use Livewire\Component;

class CreateContact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;

    public function submit(ContactService $contactService)
    {
        $contact = $contactService->create($this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]));

        if ($contact) {
            $this->reset();
            $this->dispatch('Contact_Created');
        }
    }

    public function render()
    {
        return view('livewire.front.create-contact');
    }
}
