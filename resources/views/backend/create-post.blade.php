<div class="pt-4">
    <div class="card card-body bg-white border-0">
        <div class="d-flex justify-content-between">
            <div class="text-start mt-3 mx-3">
                <span class="h3 fw-bold text-muted">{{ __('Create Post') }}</span>
            </div>
            <div class="my-3 d-flex justify-content-end">
                <div class="mx-3 text-end mt-1" wire:loading>
                    {{ mb::pageLoader() }}
                </div>
                <div class="mx-3 text-end">
                    <a wire:click="discard()" role="reset" class="done_keys btn bg-white gray shadow-sm fw-bold d-block px-5">Discard</a>
                </div>
                <div class="mx-3 text-end">
                    <a wire:click="submit('draft')" role="button" class="done_keys btn bg-white gray shadow-sm fw-bold d-block px-5">Draft</a>
                </div>
                <div class="mx-3 text-end">
                    <a wire:click="submit('published')" role="submit" class="done_keys btn bg-white gray shadow-sm fw-bold d-block px-5">Publish</a>
                </div>
            </div>
        </div>
        <div class="my-4 row">
        <label for="postTitle" class="col-lg-1 col-form-label">Title</label>
        <div class="col-12 col-lg-11" wire:key="postTitleDiv">
            <input type="text" class="form-control @error('postTitle') is-invalid border-red-300 @enderror " wire:model.defer='postTitle' id="postTitle">
            @error('postTitle') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
        </div>
        </div>
        <div class="my-3 row">
            <label for="postCategory" class="col-lg-1 col-form-label">Category</label>
            <div class="col-12 col-lg-11 mb-3" wire:key="postCategoryDiv">
                <select wire:model.defer='postCategory' class="form-select  @error('postCategory') is-invalid border-red-300 @enderror" id="postCategory" aria-label=".form-select">
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
        <div class="my-3 row">
            <label for="attachments" class="col-lg-1 col-form-label">Attachments</label>
            <div class="col-12 col-lg-11" wire:key="postAttachments">
                <input type="file" wire:model.defer='postAttachments' class="form-control" id="attachments" multiple>
            </div>
        </div>
        <div class="my-4 row">
            <label for="postTags" class="col-lg-1 col-form-label">Tags</label>
            <div class="col-12 col-lg-11 postTagsWrapper" wire:key="postTagsWrapper">
                <input type="text" data-placeholder="Write your post tags..." data-separator=" " class="form-control tagin @error('postTags')is-invalid border-red-300 @enderror" id="postTags" data-transform="input => input.toUpperCase()" />
                @error('postTags') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
                <span class="text-muted" style="font-size: 14px">Use SPACE key to separate tags</span>
            </div>
        </div>
        <div class="my-3 row">
            <label for="PostContent" class="col-12 col-form-label">Post Content:
            @error('postContent') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
            </label>
            <div class="offset- col-12" wire:ignore wire:key="PostContentDiv">
                <textarea name="PostContent" id="summernote">{{ $postContent }}</textarea>
            </div>
        </div>
    </div>
@section('page_style')
    <style scoped>
        .card.card-body{
            border-radius:20px;
        }
        .select2-selection--single {
            border: 1px solid #e5e7eb !important;
            height: 36px !important;
        }
        .select2-selection__rendered {
            padding:5px;
        }
        .select2-search--dropdown .select2-search__field ,.select2-dropdown{
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
     $('input').addClass('form-control');
    $('#summernote').summernote({
        callbacks: {
                onBlur: function(e) {
                    @this.set('postContent', e.target.innerHTML);
                }
        },
        codemirror: {
            theme: 'monokai'
        },
      placeholder: 'Write your Post here...',
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
      ]
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
