<div class="">
    <form wire:submit.prevent='updateUserPassword' class="my-5 row">
    <div class="col-12 col-md-3 col-lg-2 d-flex flex-column align-items-center text-gray-500 gap-5" >
        <span class="mt-2">Old Password</span>
        <span class="mt-2">New Password</span>
        <span class="mt-2">New Password Confirmation</span>
    </div>
    <div class="col-12 col-md-9 col-lg-10 d-flex flex-column align-items-start text-gray-500 gap-5" >
        <div class='d-flex flex-column' style="width:100%" >
            <div class="input-group"><input autocomplete="password" type="password" wire:model.defer='oldPassword' class="form-control @error('oldPassword') border-red-500 @enderror">
            </div>
            @error('oldPassword') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class='d-flex flex-column' style="width:100%" >
            <div class="input-group"><input autocomplete="off" type="password" wire:model.defer='newPassword' class="newPasswordFeild form-control @error('newPassword') border-red-500 @enderror">
                <a role="button" class="eyeToPassword btn btn-gray-200 @error('newPassword') border-red-500 @enderror"><i id="eye1" class="fas fa-eye"></i></a>
            </div>
            @error('newPassword') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class='d-flex flex-column' style="width:100%" >
            <div class="input-group"><input autocomplete="off" type="password" wire:model.defer='newPasswordConfirmation' class="newPasswordFeild form-control @error('newPasswordConfirmation') border-red-500 @enderror">
                <a role="button" class="eyeToPassword btn btn-gray-200 @error('newPasswordConfirmation') border-red-500 @enderror"><i id="eye2" class="fas fa-eye"></i></a>
            </div>
            @error('newPasswordConfirmation') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="d-flex justify-content-end gap-3 mt-5">
        <a  wire:click='resetUserPassword' class="btn btn-red-200">Reset</a>
        <button role="button" type="submit" class="btn btn-green-200">Update Password</button>
    </div>
    </form>
</div>
