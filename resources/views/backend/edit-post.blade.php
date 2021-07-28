<div class="pt-4">
    <div class="card card-body bg-white border-0">
        <div class="d-flex justify-content-between">
            <div class="text-start mt-3 mx-3">
                <span class="h3 fw-bold text-muted">{{ __('Update Post') }}</span>
            </div>
            <div class="my-3 d-flex justify-content-end">
                <div class="mx-3 text-end mt-1" wire:loading>
                    {{ mb::pageLoader() }}
                </div>
                <div class="mx-3 text-end">
                    <a wire:click="discard()" role="reset" class="submit btn bg-white gray shadow-sm fw-bold d-block px-5">Discard</a>
                </div>
                <div class="mx-3 text-end">
                    <a wire:click="submit('draft')" role="button" class="submit btn bg-white gray shadow-sm fw-bold d-block px-5">Draft</a>
                </div>
                <div class="mx-3 text-end">
                    <a wire:click="submit('published')" role="submit" class="submit btn bg-white gray shadow-sm fw-bold d-block px-5">Publish</a>
                </div>
            </div>
        </div>
        <div class="my-4 row">
        <label for="postTitle" class="col-lg-1 col-form-label">Title</label>
        <div class="col-12 col-lg-11">
            <input type="text" class="form-control @error('postTitle') is-invalid border-red-300 @enderror " wire:model.lazy='postTitle' id="postTitle">
            @error('postTitle') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
        </div>
        </div>
        <div class="my-3 row">
            <label for="Category" class="col-lg-1 col-form-label">Category</label>
            <div class="col-12 col-lg-11 mb-3">
                <select wire:model.lazy='postCategory' class="form-select  @error('postCategory') is-invalid border-red-300 @enderror" id="Category" aria-label=".form-select">
                    <option value="No Category" selected>No Category</option>
                    @if($categories)
                    @foreach ($categories as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('postCategory') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="my-4 row">
            <label for="postTags" class="col-lg-1 col-form-label">Tags</label>
            <div class="col-12 col-lg-11 postTagsWrapper" wire:key="postTagsWrapper">
                <input type="text" data-placeholder="Write your post tags..." data-separator=" " class="form-control tagin @error('postTags')is-invalid border-red-300 @enderror" id="postTags" data-transform="input => input.toUpperCase()" value='{{ $postTags }}' />
                @error('postTags') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
                <span class="text-muted" style="font-size: 14px">Use SPACE key to separate tags</span>

            </div>
        </div>

        <div class="my-3 row">
            <label for="attachments" class="col-lg-1 col-form-label">Attachments</label>
            <div class="col-12 col-lg-11">
                <input type="file" wire:model.lazy='postAttachments' class="form-control" id="attachments" multiple>
                @if($oldAttachments)<small class="text-gray-400 text-xs">Note: if you Upload a new Files, They will be merged with the old attachments!!</small>@endif
            </div>
        </div>
        <div class="mt-4">
            <label for="postTitle" class=" col-form-label">Old Attachments:</label>
            <div class="col-12 col-lg-10 pt-1 d-flex">
            @if($oldAttachments)
                @foreach ($oldAttachments as $i)
                    <div class=" d-flex flex-column">
                        <a target="_blank" href="{{ $i }}" class="bg-gray-50 gray rounded-2 p-4 m-1">
                            <i class="fas fa-paperclip"></i>
                        </a>
                        <a role ="button" onclick='delete_attachment({{ $loop->index }},"{{ str_replace("/storage/","",$i) }}")'
                        class="delete_attachment position-absolute rounded-circle px-1 bg-red-200 text-red-500">&times;</a>
                    </div>
                @endforeach
            @else
                   <span class="text-muted">No Attachments</span>
            @endif
            </div>
        </div>
        <div class="my-3 row">
            <label for="PostContent" class="col-12 col-form-label">Post Content:
            @error('postContent') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
            </label>
            <div class="offset- col-12" wire:ignore>
                <textarea wire:model='postContent' name="PostContent" id="summernote">{{ $postContent }}</textarea>
            </div>
        </div>
    </div>
@section('page_style')
    <style scoped>
        .card.card-body{
            border-radius:20px;
        }
        .select2-container--default .select2-selection--single {
            border: 1px solid #e5e7eb !important;
        }
    </style>
@endsection
@section('page_script')
<link rel="stylesheet" href="{{ asset('plugins/tagin/dist/css/tagin.css') }}">
<script src="{{ asset('plugins/tagin/dist/js/tagin.js')}}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        for (const el of $('.tagin')) {
            tagin(el)
        }
        // Livewire.emit('getPostTags', e);
        window.initSelectTags=()=>{
            $('#postCategory').select2();
        }
        initSelectTags();
        $('#postCategory').on('change', function (e) {
            @this.set('postCategory', e.target.value)
        });
        window.livewire.on('select2',()=>{
            initSelectTags();
            for (const el of $('.tagin')) {
                tagin(el)
            }
        });
        window.livewire.on('swal_success',()=>{
                setTimeout(() => {
                    window.location.href="{{ route('admin.posts') }}"
                }, 1000);
            });
        $('.tagin-input').blur(function() {
            @this.set('postTags', $('#postTags').val());
          })
    });
    function delete_attachment(id,title) {
    const delete_attachment = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-red-200  mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })
    delete_attachment.fire({
        html:'<h5 class="mt-2 mb-1 text-red-500">Are you Sure you want to delete this attachment ?</h5><br><h3>'+title+'</h3>',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('delete_attachments',id)
    }
    })
}
    $('#summernote').summernote({
        callbacks: {
            onBlur: function(e) {
                @this.set('postContent', e.target.innerHTML);
            }
        },
        placeholder: 'Write Post Content here...',
        tabsize: 1,
        height: 300,
        maxHeight:700,
        lineHeight: '0.6',
        lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height',['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']],
        ],
    });
  </script>
  <style class="">
      .note-editable{
          background-color:#fff;
      }
      .is-invalid{
          font-size:14px;
      }
  </style>
@endsection
</div>
