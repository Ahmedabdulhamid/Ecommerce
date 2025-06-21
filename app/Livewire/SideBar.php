<?php
namespace App\Livewire;

use App\Models\Admin;
use Livewire\Component;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Countary;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;

class SideBar extends Component
{
    public $products, $users, $admins, $brands, $categories, $faqs, $permissions, $roles;
    public $attributesCount, $coupones, $countaries, $settings,$contacts,$sliders,$pages,$orders;

    // استماع للحدث الصحيح
    protected $listeners = ['refreshData' => 'updateCounts'];

    public function mount()
    {
        $this->updateCounts();
    }

    public function updateCounts()
    {
        $this->products = Product::count();
        $this->users = User::count();
        $this->brands = Brand::count();
        $this->coupones = Coupon::count();
        $this->permissions = Permission::count();
        $this->roles = Role::count();
        $this->faqs = Faq::count();
        $this->categories = Category::count();
        $this->countaries = Countary::count();
        $this->attributesCount = Attribute::count();
        $this->settings = Setting::count();
        $this->admins=Admin::count();
        $this->contacts=Contact::count();
        $this->sliders=Slider::count();
        $this->pages=Page::count();
        $this->orders=Order::count();
    }

    public function render()
    {
        return view('livewire.side-bar');
    }
}
