<div class="rounded-rem bg-white shadow-sm pt-4 mt-3">
    <span class="text-gray-800 h3 px-4">{{ __('SEO')}}</span>
    <div class="px-5 my-5 row" id="seoSettingsDiv">
        <div class="col-12 d-flex flex-column align-items-start text-gray-500 gap-4">
            <div class=" rounded-rem bg-whire">
                @if($favicon)
                <a role="button" wire:click='clearFavicon' class="position-absolute rounded-circle px-1 bg-red-200 text-red-500 fw-bold">&times;</a>
                <img src="{{ asset($favicon->temporaryUrl()) }}" width="90px" height="90px" alt="" class="profile-img rounded-5 shadow-sm">
                @else
                <img src="{{ asset(config('settings.favicon')) }}" width="90px" height="90px" alt="" class="profile-img rounded-5 shadow-sm">
                @endif
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-4 mb-1 text-gray-400">{{ __('Favicon')}} </span>
                <input type="file" wire:model.defer='favicon' class="form-control @error('favicon') border-red-500 @enderror" accept="image/png, image/jpg, image/jpeg">
                <span class="text-gray-400" style="font-size: 14px">{{ __('max dimensions is 512x512')}}</span>
                @error('favicon') <span class="text-red-500 fw-bold " style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-4 mb-1 text-gray-400">{{ __('Website Name')}} <span class="text-red-400">*</span></span>
                <input type="text" wire:model='app_name' class="form-control @error('app_name') border-red-500 @enderror">
                @error('app_name') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
        <form wire:submit.prevent='updateWebSettings(Object.fromEntries(new FormData(event.target)))' class='d-flex flex-column' style="width:100%" >

            <div class="form-group">
              <label class="mt-4 mb-1" for="lang">{{ __('Defualt Language') }}</label>
              <select class="form-control" name="lang" id="lang">
                  <option selected value ="en" >{{ __('en') }}</option>
                  <option value ="en" disabled>{{ __('more lang soon') }}</option>
              </select>
            </div>

            <div class="form-group">
                <label class="mt-4 mb-1" for="dir">{{ __('Defualt Direction') }}</label>
                <select class="form-control" name="dir" id="dir">
                    <option {{ config('web_settings.dir') == 'lte' ? 'selected' : ''}}
                    value ="lte" >
                        {{ __('Left to Right') }}
                    </option>
                    <option {{ config('web_settings.dir') == 'rtl' ? 'selected' : ''}}
                    value ="rtl" >
                        {{ __('Right to Left') }}
                    </option>
                </select>
            </div>

            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-4 mb-1 text-gray-400">{{ __('Home Page Title') }}</span>
                <input value="{{ $webSettings['page_title_home'] }}" type="text" name='page_title_home' class="form-control">
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-4 mb-1 text-gray-400">{{ __('Home Page Description') }}</span>
                <input value="{{ $webSettings['page_description_home'] }}" type="text" name='page_description_home' class="form-control">
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-4 mb-1 text-gray-400">{{ __('Home Page Keywords') }}</span>
                <input value="{{ $webSettings['page_keywords_home'] }}" type="text" name='page_keywords_home' class="form-control">
                <span class="text-gray-400" style="font-size: 13px">
                    {{ __('Use Comma ( , ) to separate the tags, Example: tech,phones,apps')}}
                </span>
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-4 mb-1 text-gray-400">{{ __('Home Page Author') }}</span>
                <input value="{{ $webSettings['page_author_home'] }}" type="text" name='page_author_home' class="form-control">
            </div>


            {{-- <div class="d-flex flex-column" style="width:100%" >
                <label for="static_page" class="mt-3">Static Pages SEO</label>
                <div class="" wire:key="static_pageDiv">
                    <select wire:model='static_page' class="form-select  @error('static_page') is-invalid border-red-300 @enderror" id="static_page" aria-label=".form-select">
                        <option value='0' selected>No Static Page</option>
                        @if($static_pages)
                        @foreach (explode('|',$static_pages) as $page)
                        <option value="{{ $page }}">{{ $page }}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('static_page') <span class="text-red-500 is-invalid">{{ $message }}</span> @enderror
                </div>
            </div>
            @if($static_page)
            <div class="d-flex flex-column" style="width:50%">
                <div class='d-flex flex-column' style="width:100%" >
                    <span class="mt-3">{{ $static_page }} Title</span>
                    <input type="text" class="form-control">
                    <span class="text-gray-400" style="font-size: 14px"></span>
                </div>
                <div class='d-flex flex-column' style="width:100%" >
                    <span class="mt-3">{{ $static_page }} Description</span>
                    <input type="text" class="form-control">
                    <span class="text-gray-400" style="font-size: 14px"></span>
                </div>
                <div class='d-flex flex-column' style="width:100%" >
                    <span class="mt-3">{{ $static_page }} Keywords</span>
                    <input type="text" class="form-control">
                    <span class="text-gray-400" style="font-size: 13px">Use Comma ( , ) to separate the tags, Example: tech,phones,apps</span>
                </div>
                <div class='d-flex flex-column' style="width:100%" >
                    <span class="mt-3">{{ $static_page }} Author</span>
                    <input type="text" class="form-control">
                    <span class="text-gray-400" style="font-size: 14px"></span>
                </div>
            </div>
            @endif --}}

            {{-- <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2">youtube</span>
                <input type="text" wire:model.defer='youtube' class="form-control @error('youtube') border-red-500 @enderror">
                @error('youtube') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-3">github</span>
                <input type="text" wire:model.defer='github' class="form-control @error('github') border-red-500 @enderror">
                @error('github') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2">reddit</span>
                <input type="text" wire:model.defer='reddit' class="form-control @error('reddit') border-red-500 @enderror">
                @error('reddit') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2">goodreads</span>
                <input type="text" wire:model.defer='goodreads' class="form-control @error('goodreads') border-red-500 @enderror">
                @error('goodreads') <span class=" text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div>
            <div class='d-flex flex-column' style="width:100%" >
                <span class="mt-2">pinterest</span>
                <input type="text" wire:model.defer='pinterest' class="form-control @error('pinterest') border-red-500 @enderror">
                @error('pinterest') <span class="text-red-500 fw-bold" style="font-size: 14px">{{ $message }}</span> @enderror
            </div> --}}

            </div>
            <div class="d-flex justify-content-end gap-3 my-5">
                <button id="resetInput" type="button" class="btn btn-red-200">Reset</button>
                <button type="submit" class="btn btn-green-200">Update Profile</button>
            </div>
        </form>
    </div>
@section('page_script')
<script>
$('#resetInput').click(function(){
    @this.set('favicon' , '');
    @this.set('app_name' , '');
    $('#seoSettingsDiv input').val('');
})
</script>
@endsection
</div>
