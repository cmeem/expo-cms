<?php

namespace App\Http\Controllers\Backend\Settings;

use Livewire\Component;
use App\Models\Settings;
use App\Models\WebSettings;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;

class Seo extends Component
{
    use WithFileUploads;

    public $favicon;
    public $app_name;
    public $webSettings;

    // public $static_pages;

    function rules() {
        return [
            'favicon' => 'nullable|max:512|mimes:jpg,png,jpeg|dimensions:max_width=512,max_height=512',
            'app_name' => 'required|min:2|alpha',
            // 'static_pages' => ['required','min:2','regex:/^[a-zA-Z-.]*$/'],
            // 'email' => 'required|email|unique:admins,email,'.auth()->user()->id,
            // 'phone' => 'required|phone_number|max:30|min:6|unique:admins,phone,'.auth()->user()->id,
        ];
    }
    protected $messages = [
        'admin_avatar.mimes'=>'The Favicon must be an image.',
        'admin_avatar.max'=>'Maximum image size is 512KB.',
        'admin_avatar.dimensions'=>'Image dimensions must be at least 256x256.',
        'app_name.required' => "Website Name is required.",
        'app_name.alpha' => "Website Name  must only contain letters.",
        'app_name.min' => "Website Name must be at least :min characters long.",
        // 'static_pages.required' => "Static pages is required.",
        // 'static_pages.regex' => "Static pages  must only contain letters or (-).",
        // 'static_pages.min' => "Static pages must be at least :min characters long.",
        // 'username.required' =>"Please enter username.",
        // 'username.unique' =>"Username has already been taken.",
        // 'username.min' =>"Username must be at least :min characters long.",
        // 'username.without_spaces' =>"Username should not contain spaces.",
        // 'email.required' =>"Please enter email address.",
        // 'email.unique' =>"Email has already been taken.",
        // 'email.email' =>"Please enter vaild email address.",
        // 'phone.required' =>"Please enter phone number.",
        // 'phone.unique' =>"Phone number has already been taken.",
        // 'phone.phone_number' =>"Phone number must be digits only.",
    ];

    public function mount(){
        $this->app_name = config('settings.app_name');
        $this->webSettings = WebSettings::all()->pluck('value', 'key')->toArray();
        // $this->static_pages = config('settings.static_pages');
    }

    public function hydrate(){
        // $this->emit('staticPages');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('backend.settings.seo');
    }

    public function clearFavicon(){
        $this->favicon = NULL;
        $this->resetErrorBag();
    }

    public function updateWebSettings($formData){
        foreach($formData as $key => $value){
            WebSettings::where('key',$key)->update([
                'value' => $value,
            ]);
        }
        Cache::forget('web_settings');
    }
}
