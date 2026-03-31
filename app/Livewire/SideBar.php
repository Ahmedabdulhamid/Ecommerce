<?php
namespace App\Livewire;

use App\Support\AdminCache;
use Livewire\Component;

class SideBar extends Component
{
    public $products, $users, $admins, $brands, $categories, $faqs, $permissions, $roles;
    public $attributesCount, $coupones, $countaries, $settings,$contacts,$sliders,$pages,$orders,$userQuestions;

    // استماع للحدث الصحيح
    protected $listeners = [
        'refreshData' => 'updateCounts',
        "refreshAdmins"=>"refreshAdmins"
];

    public function mount()
    {
        $this->loadCounts();
    }

    public function loadCounts(): void
    {
        foreach (AdminCache::sidebarCounts() as $property => $value) {
            $this->{$property} = $value;
        }
    }

    public function updateCounts()
    {
        AdminCache::flush(['admin.sidebar']);

        $this->loadCounts();
    }

    public function refreshAdmins()
    {
        AdminCache::flush(['admin.sidebar']);

        $this->loadCounts();
    }

    public function render()
    {
        return view('livewire.side-bar');
    }
}
