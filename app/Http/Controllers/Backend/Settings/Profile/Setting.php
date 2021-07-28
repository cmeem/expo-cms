<?php

namespace App\Http\Controllers\Backend\Settings\Profile;

use Livewire\Component;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

class Setting extends Component
{
    public $sidebar_visibility;
    protected $listeners = ['restore_default'];

    public function mount(){
        $this->sidebar_visibility = auth()->user()->settings->where('key','sidebar_visibility')->first()->toarray()['value'];
    }

    public function render()
    {
        return view('backend.settings.profile.settings');
    }

    public function update_settings()
    {
        $this->validate(['sidebar_visibility' => 'required']);
        Settings::where('admin_id',auth()->user()->id)->where('key','sidebar_visibility')->update([
            'value' => $this->sidebar_visibility
        ]);
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Your settings has been updated.</span>',
        ]);
        Cache::forget('settings');
    }
    public function restore_default()
    {
        foreach (auth()->user()->settings as $setting){
            if($setting->key != 'app_name'){
                Settings::where('admin_id',auth()->user()->id)->where('key',$setting->key)->update([
                    'value' => $setting->defualt_value
                ]);
            };
        }
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Settings has been restored to Default.</span>',
        ]);
        Cache::forget('settings');
    }
}
