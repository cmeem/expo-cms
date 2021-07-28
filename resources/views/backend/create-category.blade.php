<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="create_categoryLabel">New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="create_category">
            <div class="mb-3">
            <label for="category_name" class="col-form-label">Name:</label>
            <input type="text" wire:model.defer='category_name' class="form-control @error('category_name') is-invalid border-red-300 @enderror" id="category_name">
            @error('category_name') <span class="text-red-500 is-invalid" style="font-size: 14px">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="category_details" class="col-form-label">Details:</label>
            <textarea wire:model.defer='category_details' class="form-control  @error('category_details') is-invalid border-red-300 @enderror" id="category_details"></textarea>
            @error('category_details') <span class="text-red-500 is-invalid" style="font-size: 14px">{{ $message }}</span> @enderror
            <span class="text-muted" style="font-size: 14px">Provide Details field will help Search engines to index the Category.</span>
            </div>
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-gray-200" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-green-200">Create Category</button>
    </div>
        </form>
    </div>
</div>

