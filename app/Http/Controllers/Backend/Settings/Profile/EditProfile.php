<?php

namespace App\Http\Controllers\Backend\Settings\Profile;

use App\Classes\Mb;
use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditProfile extends Component
{
    use WithFileUploads;

    public $fullname;
    public $username;
    public $email;
    public $phone;
    public $avatar;

    function rules() {
        return [
            'fullname' => 'required|min:3|letters_only',
            'username' => 'required|min:3|without_spaces|unique:admins,username,'.auth()->user()->id,
            'email' => 'required|email|unique:admins,email,'.auth()->user()->id,
            'phone' => 'required|phone_number|max:30|min:6|unique:admins,phone,'.auth()->user()->id,
            'avatar' => 'nullable|max:1024|mimes:jpg,png,jpeg|dimensions:min_width=64,min_height=64',
        ];
    }
    protected $messages = [
        'fullname.required' => "Please enter Full Name.",
        'fullname.letters_only' => "Full Name must be string only (letters only).",
        'fullname.min' => "Full Name must be at least :min characters long.",
        'username.required' =>"Please enter username.",
        'username.unique' =>"Username has already been taken.",
        'username.min' =>"Username must be at least :min characters long.",
        'username.without_spaces' =>"Username should not contain spaces.",
        'email.required' =>"Please enter email address.",
        'email.unique' =>"Email has already been taken.",
        'email.email' =>"Please enter vaild email address.",
        'phone.required' =>"Please enter phone number.",
        'phone.unique' =>"Phone number has already been taken.",
        'phone.phone_number' =>"Phone number must be digits only.",
        'admin_avatar.mimes'=>'The avatar must be an image.',
        'admin_avatar.max'=>'Maximum image size is 1MB.',
        'admin_avatar.dimensions'=>'Image dimensions must be at least 64*64.'
    ];


    public function mount(){
        $this->fullname = auth()->user()->fullname;
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;

    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('backend.settings.profile.edit-profile');
    }

    public function clearAvatar(){
        $this->avatar=NULL;
    }

    public function resetUserProfile(){
        $this->fullname = auth()->user()->fullname;
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->avatar = NULL ;
        $this->resetErrorBag();

    }

    public function updateUserProfile(){
        Mb::ArToEnNum($this->phone);
        $this->validate();
        $attachments = $this->avatar;
        if ($attachments) {
            $extension = $attachments->getClientOriginalExtension();
            $fileNameToStore = 'avatar-'. time() .'.'.$extension;
            $attachments->storeAs('public', '/avatars/'.$fileNameToStore);
            $postAttachments = '/storage/avatars/'.$fileNameToStore;
            if(auth()->user()->avatar != '/img/profile.png'){
                Storage::disk('public')->delete(str_replace('/storage/','',auth()->user()->avatar));
            }
        }
        isset($postAttachments) ? '' : $postAttachments = auth()->user()->avatar;
        Admin::where('id',auth()->user()->id)->update([
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $postAttachments
        ]);
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Your profile has been updated.</span>',
        ]);
    }

}


