<?php

namespace App\Http\Controllers\Backend\Settings\Profile;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{

    public $oldPassword;
    public $newPassword;
    public $newPasswordConfirmation;

    public function render()
    {
        return view('backend.settings.profile.change-password');
    }

    public function resetUserPassword(){
        $this->oldPassword=NULL;
        $this->newPassword=NULL;
        $this->newPasswordConfirmation=NULL;
        $this->resetErrorBag();

    }
    public function updateUserPassword(){
        $user = auth()->user();
        $this->validate([
            'oldPassword' => ['required','min:6',function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The provided password not correct.');
                }
            }],
            'newPassword' => ['required_with:oldPassword','min:6','regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/','different:oldPassword'],
            'newPasswordConfirmation' => 'required_with:newPassword|same:newPassword'
        ],[
            'oldPassword.required' =>"Please enter the old password.",
            'oldPassword.min' =>"Old password must be at least :min characters long.",
            'newPassword.required_with' =>"Please enter the new password.",
            'newPassword.min' =>"New password must be at least :min characters long.",
            'newPassword.regex' =>"New password must contain: Uppercase, lowercase, digits.",
            'newPassword.different' =>"New password and old password must be different.",
            'newPasswordConfirmation.required_with' =>"Please enter password confirmation.",
            'newPasswordConfirmation.same' =>"Password and password confirmation does not match.",
        ]);
        Admin::where('id',auth()->user()->id)->update([
            'password' => Hash::make($this->newPassword)
        ]);
        $this->resetUserPassword();
        $this->dispatchBrowserEvent('swal',[
            'html' =>'<span class="d-flex align-items-center fw-bold text-gray-800 mb-2"><i class="fas fa-check fa-2x text-green-500" style="margin-right:1rem;"></i>Your Password has been updated.</span>',
        ]);
    }
}
