<?php

namespace App\Livewire\Front;

use App\Events\CreateContactEvent;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\CreateNotificaction;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class CreateContact extends Component
{
    public $name,$email,$subject,$message;
    public function submit()
    {
       $data= $this->validate([
            'name'=>"required|string|max:255",
            "email"=>"required|string|email|max:255",
            "subject"=>'required|max:255',
            'message'=>'required'
        ]);
        $data['is_read']=0;
        $data['is_replied']=0;
        $contact=Contact::create($data);
        if ($contact) {
           $this->reset();
           $this->dispatch('Contact_Created');
           $admins=Admin::all();
           Notification::send($admins,new CreateNotificaction($contact));
           foreach ($admins as $admin) {
            $latestNotification=$admin->notifications()->latest()->first();
            broadcast(new CreateContactEvent($contact,$admin, $latestNotification))->toOthers();

           }

        }
    }
    public function render()
    {
        return view('livewire.front.create-contact');
    }
}
