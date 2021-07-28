<div class="">
    <span class="mt-0 text-gray-400" style="font-size: 14px">Just enter User Name, examples: for twitter (mocha-v6) | for instagram  (laravel-expo)</span>
    <form wire:submit.prevent='updateSocialMedia' class="my-5 row">
        <div class="col-12 d-flex flex-column align-items-start text-gray-500 gap-5">
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2 text-blue-400"><i class="fab fa-twitter"></i> twitter </span>
                <input type="text" wire:model.defer='twitter' class="form-control text-blue-400 @error('twitter') border-red-500 @enderror">
                @error('twitter') <span class="text-red-500 fw-bold " style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-3 text-pink-600"><i class="fab fa-instagram"></i> instagram </span>
                <input type="text" wire:model.defer='instagram' class="form-control text-pink-600 @error('instagram') border-red-500 @enderror">
                @error('instagram') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2 text-blue-700"><i class="fab fa-facebook"></i> facebook </span>
                <input type="text" wire:model.defer='facebook' class="form-control text-blue-700 @error('facebook') border-red-500 @enderror">
                @error('facebook') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2 text-red-600"><i class="fab fa-youtube"></i> youtube </span>
                <input type="text" wire:model.defer='youtube' class="form-control text-red-600 @error('youtube') border-red-500 @enderror">
                @error('youtube') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-3 text-gray-800"><i class="fab fa-github"></i> github </span>
                <input type="text" wire:model.defer='github' class="form-control text-gray-800 @error('github') border-red-500 @enderror">
                @error('github') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2" style="color: #f87203;"><i class="fab fa-reddit"></i> reddit </span>
                <input type="text"  style="color: #f87203;" wire:model.defer='reddit' class="form-control @error('reddit') border-red-500 @enderror">
                @error('reddit') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2 text-yellow-400"><i class="fab fa-goodreads"></i> goodreads </span>
                <input type="text" wire:model.defer='goodreads' class="form-control  text-yellow-400 @error('goodreads') border-red-500 @enderror">
                @error('goodreads') <span class=" text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2  text-red-600"><i class="fab fa-pinterest"></i> pinterest </span>
                <input type="text" wire:model.defer='pinterest' class="form-control text-red-600 @error('pinterest') border-red-500 @enderror">
                @error('pinterest') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>

        </div>
        <div class="d-flex justify-content-end gap-3 mt-5">
            <button role="button" type="reset" wire:click='resetSocialMedia' class="btn btn-red-200">Reset</button>
            <button type="submit" class="btn btn-green-200">Update Profile</button>
        </div>
    </form>
</div>
