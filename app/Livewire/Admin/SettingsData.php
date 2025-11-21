<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;

class SettingsData extends Component
{
    use WithFileUploads;
    public $site_name = ['ar' => '', 'en' => ''];
    public $site_desc = ['ar' => '', 'en' => ''];
    public $meta_description = ['ar' => '', 'en' => ''];
    public $site_email = '';
    public $site_address = ['ar' => '', 'en' => ''];
    public $email_support = '';
    public $logo;
    public $promotion_video_url;
    protected $listeners = ['refreshData' => '$refresh'];

    public function rules()
    {
        return [
            'site_name.ar' => ['required'],
            'site_name.en' => ['required'],
            'site_desc.ar' => ['required'],
            'site_desc.en' => ['required'],
            'meta_description.ar' => ['required'],
            'meta_description.en' => ['required'],
            'site_email' => ['required', 'email'],
            'site_address.ar' => ['required'],
            'site_address.en' => ['required'],
            'email_support' => ['required'],
            'logo' => ['nullable', 'mimes:jpg,bmp,png,svg,wepb'],
            'promotion_video_url' => ['nullable', 'mimetypes:video/mp4,video/mpeg,video/quicktime'],
        ];
    }
    public function mount()
    {
        $setting = Setting::first(); // أو أي طريقة لجلب الإعدادات

        $this->site_name['ar'] = $setting->getTranslation('site_name', 'ar');
        $this->site_name['en'] = $setting->getTranslation('site_name', 'en');

        $this->site_desc['ar'] = $setting->getTranslation('site_desc', 'ar');
        $this->site_desc['en'] = $setting->getTranslation('site_desc', 'en');

        $this->meta_description['ar'] = $setting->getTranslation('meta_description', 'ar');
        $this->meta_description['en'] = $setting->getTranslation('meta_description', 'en');

        $this->site_email = $setting->site_email;
        $this->site_address['ar'] = $setting->getTranslation('site_address', 'ar');
        $this->site_address['en'] = $setting->getTranslation('site_address', 'en');
        $this->email_support = $setting->email_support;
    }

    public function submit()
    {
        $setting = Setting::first();

        $data = $this->validate();
        if ($this->logo) {
            Storage::delete('public/settings/'.$setting->logo);
            $newlogo = time() . '-' . $this->logo->getClientOriginalName();
            $this->logo->storeAs('settings', $newlogo, 'public');
            $data['logo'] = $newlogo;

        }

        $setting->update($data);
        $this->resetValidation();
        $this->dispatch('refreshData');



    }
    public function render()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        return view('livewire.admin.settings-data', ['setting' => Setting::get()]);
    }
}
