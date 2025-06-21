<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use App\Notifications\ContactNotification;
use Livewire\Component;

class ContactShow extends Component
{
    public $contactMsg;
    public $email, $subject, $reply;
    protected $listeners = ['getContact', 'getContact'];

    public function getContact($contact)
    {

        $this->contactMsg = $contact;
        $this->email = $contact['email'];
        $this->subject = $contact['subject'];
    }
    public function submit()
    {

        $contact = Contact::where('id', $this->contactMsg['id'])->first();
        if ($contact->is_replied == 0) {
            $contact->update([
                'is_replied' => 1
            ]);
            $this->dispatch('refreshReplies')->to('admin.contacts.contact-message');
        }
        $contact->notify(new ContactNotification($this->contactMsg, $this->reply));
        $this->dispatch('hideModal');
    }
    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        $this->dispatch('deleteMsg');
        $this->dispatch('refreshMsg')->to('admin.contacts.contact-message');
        $this->contactMsg = null;
        $this->dispatch('updateTrash')->to('admin.contacts.contact-message-sidebar');
        $this->dispatch('updateInbox')->to('admin.contacts.contact-message-sidebar');
    }

    #[\Livewire\Attributes\On('deleteConfirmed')]
    public function forcedeleteContact($id)
    {

        $contact = Contact::withTrashed()->find($id);

        if ($contact) {
            $contact->forceDelete();
            $this->dispatch('confirmDelete');
            $this->dispatch('updateTrash')->to('admin.contacts.contact-message-sidebar');
            $this->dispatch('refreshMsg')->to('admin.contacts.contact-message');
            $this->dispatch('updateInbox')->to('admin.contacts.contact-message-sidebar');
            $this->dispatch('refreshMsg')->to('admin.contacts.contact-message');
            $this->contactMsg = null;
        }
    }
    public function restoreContact($id){
       $contact=Contact::withTrashed()->where('id',$id)->first();
       $contact->restore();
       $this->dispatch('updateTrash')->to('admin.contacts.contact-message-sidebar');
       $this->dispatch('updateInbox')->to('admin.contacts.contact-message-sidebar');
       $this->dispatch('refreshMsg')->to('admin.contacts.contact-message');
       $this->dispatch('showMsg');
       $this->contactMsg = null;
    }
    public function render()
    {
        return view('livewire.admin.contacts.contact-show');
    }
}
