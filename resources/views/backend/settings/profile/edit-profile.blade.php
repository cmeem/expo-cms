<div class="my-5 row">
    <div class="col-12 col-md-3 col-lg-2 d-flex flex-column align-items-center text-gray-500 gap-5" >
        <span class="mt-2">Full Name</span>
        <span class="mt-2">Username</span>
        <span class="mt-2">Email</span>
        <span class="mt-3">Phone</span>
        <span class="mt-2">Avatar</span>
        <span class="mt-2">Avatar preview</span>
    </div>
    <div class="col-12 col-md-9 col-lg-10 d-flex flex-column align-items-start text-gray-500 gap-5">
        <div class='d-flex flex-column' style="width:100%" >
            <input type="text" wire:model='fullname' class="form-control @error('fullname') border-red-500 @enderror">
            @error('fullname') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class='d-flex flex-column' style="width:100%" >
            <input type="text" wire:model='username' class="form-control @error('username') border-red-500 @enderror">
            @error('username') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class='d-flex flex-column' style="width:100%" >
            <div class="input-group"><input type="email" wire:model='email' class="form-control @error('email') border-red-500 @enderror"> @if(! auth()->user()->email_verified_at) <a role="button" class="btn btn-indigo-100 @error('email') border-red-500 @enderror">Send Verification Link</a> @endif</div>
            @error('email') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class='d-flex flex-column' style="width:100%" >
            <input type="tel" wire:model='phone' class="form-control @error('phone') border-red-500 @enderror">
            <span class="text-gray-400" style="font-size: 12px">example: 97150123456 or 50123456</span>
            @error('phone') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class='d-flex flex-column' style="width:100%" >
            <input type="file" wire:model='avatar' class="form-control @error('avatar') border-red-500 @enderror" accept="image/png, image/jpg, image/jpeg">
            <span class="text-gray-400" style="font-size: 12px">max image size 1MB</span>
            @error('avatar') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>

        <div class=" rounded-rem bg-whire">
            @if($avatar)
            <a role="button" wire:click='clearAvatar' class="position-absolute rounded-circle px-1 bg-red-200 text-red-500 fw-bold">&times;</a>
            <img src="{{ asset($avatar->temporaryUrl()) }}" width="90px" height="90px" alt="" class="profile-img rounded-5 shadow-sm">
            @else
            <img src="{{ asset(auth()->user()->avatar) }}" width="90px" height="90px" alt="" class="profile-img rounded-5 shadow-sm">
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-end gap-3 mt-5">
        <button wire:click='resetUserProfile' class="btn btn-red-200">Reset</button>
        <button wire:click='updateUserProfile' class="btn btn-green-200">Update Profile</button>
    </div>
</div>
