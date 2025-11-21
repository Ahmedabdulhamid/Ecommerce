<?php

namespace App\Livewire\Front;


use App\Models\WebFaqQuestion;
use Livewire\Component;

class FaqQuestion extends Component
{
    public $email, $name, $subject, $message;
    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->email = $user->email;
            $this->name = $user->name;
        } else {
            $this->email = '';
            $this->name = '';
        }
    }

    public function submit()
    {

        $data = $this->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'subject' => ['required'],
            'message' => ['required']

        ]);
        if (auth()->user()) {
            $faq_question = WebFaqQuestion::create($data);
            $this->reset(['subject','message']);
            $this->dispatch('success_Msg',__('front.success_faq_msg'));
        } else {
            $this->dispatch('Error_Msg');
        }
    }
    public function render()
    {
        return view('livewire.front.faq-question');
    }
}
