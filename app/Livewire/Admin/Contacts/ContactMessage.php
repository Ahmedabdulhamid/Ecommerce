<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ContactMessage extends Component
{
    use WithPagination,WithoutUrlPagination;
    protected $listeners = [
        'refreshMsg' => '$refresh',
        'refreshContact' => '$refresh',
        'refreshReplies' => '$refresh',
        'selectScreen' => "selectScreen"
    ];

    public $itemSearch = '', $screen = 'Inbox';

    public function updatingItemSearch()
    {
        $this->resetPage();
    }
    public function submit($messageId)
    {

        $contact = Contact::withTrashed()->where('id', $messageId)->first();

        if ($contact->is_read == 0) {
            $contact->update([
                'is_read' => 1
            ]);
        }

        $this->dispatch('refreshContact');
        $this->dispatch('getContact', $contact)->to('admin.contacts.contact-show');
    }
    public function selectScreen($screen)
    {
        $this->screen = $screen;
        $this->resetPage();
    }
    public function render()
{
    $messages = Contact::query();

    if ($this->screen == 'Readed') {
        $messages->where('is_read', 1);
    } elseif ($this->screen == 'Un Readed') {
        $messages->where('is_read', 0);
    } elseif ($this->screen == 'Answerd') {
        $messages->where('is_replied', 1);
    } elseif ($this->screen == 'un Answerd') {
        $messages->where('is_replied', 0);
    } elseif ($this->screen == 'Trash') {
        $messages = Contact::onlyTrashed();
    }

    if ($this->itemSearch) {
        $messages->where(function ($query) {
            $query->where('name', 'like', '%' . $this->itemSearch . '%')
                ->orWhere('email', 'like', '%' . $this->itemSearch . '%');
        });
    }

    return view('livewire.admin.contacts.contact-message', [
        'contacts' => $messages->orderByDesc('id')->paginate(5),
    ]);
}

}
