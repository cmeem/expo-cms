<?php

namespace App\Http\Controllers\Backend\Settings\Profile;

use App\Models\Admin;
use Livewire\Component;

class SocialMedia extends Component
{
    public $twitter;
    public $facebook;
    public $instagram;
    public $youtube;
    public $github;
    public $reddit;
    public $goodreads;
    public $pinterest;

    protected $rules = [
        'twitter'=>['nullable','without_spaces'],
        'facebook'=>['nullable','without_spaces'],
        'instagram'=>['nullable','without_spaces'],
        'youtube'=>['nullable','without_spaces'],
        'github'=>['nullable','without_spaces'],
        'reddit'=>['nullable','without_spaces'],
        'goodreads'=>['nullable','without_spaces'],
        'pinterest'=>['nullable','without_spaces'],
    ];
    protected $messages = [
        'without_spaces'=>':attribute feild should be without spaces',
    ];
    public function mount(){
        $this->twitter = auth()->user()->twitter;
        $this->facebook = auth()->user()->facebook;
        $this->instagram = auth()->user()->instagram;
        $this->youtube = auth()->user()->youtube;
        $this->github = auth()->user()->github;
        $this->reddit = auth()->user()->reddit;
        $this->goodreads = auth()->user()->goodreads;
        $this->pinterest = auth()->user()->pinterest;
    }
    public function render()
    {
        return view('backend.settings.profile.social-media');
    }
    public function resetSocialMedia(){
        $this->twitter = auth()->user()->twitter;
        $this->facebook = auth()->user()->facebook;
        $this->instagram = auth()->user()->instagram;
        $this->youtube = auth()->user()->youtube;
        $this->github = auth()->user()->github;
        $this->reddit = auth()->user()->reddit;
        $this->goodreads = auth()->user()->goodreads;
        $this->pinterest = auth()->user()->pinterest;
        $this->resetErrorBag();
    }
    public function updateSocialMedia(){
        $validations = $this->validate();
        Admin::where('id',auth()->user()->id)->update($validations);
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Your Social Media Accounts has been updated.</span>',
        ]);
    }
}
