<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Livewire\Component;

class ContactMessageSidebar extends Component
{
    public $screen='Inbox';
    protected $listeners=[
        'updateTrash'=>'updateTrash',
        'updateInbox'=>'updateInbox'


];
    public $inbox,$trash,$starred,$read,$unRead,$answered,$unAnswered;
    public function mount(){
        $this->inbox=Contact::count();
        $this->trash=Contact::onlyTrashed()->count();
        $this->read=Contact::where('is_read',1)->count();
        $this->unRead=Contact::where('is_read',0)->count();
        $this->unAnswered=Contact::where('is_replied',0)->count();
        $this->answered=Contact::where('is_replied',1)->count();
    }
    public function updateTrash(){
        $this->trash=Contact::onlyTrashed()->count();
    }
    public function updateInbox(){
        $this->inbox=Contact::count();
    }
    public function selectScreen($screen){
        $this->screen=$screen;
        $this->dispatch('selectScreen',$screen);
    }
    public function render()
    {
        return view('livewire.admin.contacts.contact-message-sidebar');
    }
}
