<div class="my-5 row">
    <div class="col-12 col-md-3 col-lg-2 d-flex flex-column align-items-center text-gray-500 gap-5" >
        <span class="mt-2">Sidebar Visibility</span>
    </div>
    <div class="col-12 col-md-9 col-lg-10 d-flex flex-column align-items-start text-gray-500 gap-5" >
        <select wire:model.defer='sidebar_visibility' class="form-control">
            <option value="mini">mini</option>
            <option value="visible">visible</option>
        </select>
        {{-- @error('sidebar_visibility') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror --}}
    </div>
    <div class="d-flex justify-content-end gap-3 mt-5">
        <button onclick='restore_default();' class="btn btn-red-200">Restore default</button>
        <button wire:click='update_settings' class="btn btn-green-200">Update Settings</button>
    </div>
</div>
