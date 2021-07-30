<div class="navbar rounded-rem bg-white mx-2 mx-md-4 row" id="header">
    <!-- main navbar left --buttons-- -->
    <div class="col-6 d-flex justify-content-start">
        <button id="sidebar-toggle" role="button" class="btn gray hover-gray rounded-4 nav-light-button bg-white mx-1">
            <i class="fas fa-arrow-right"></i>
        </button>
        <a href="{{ route('admin.posts.create') }}" class="btn bg-white gray rounded-4 nav-light-button d-none d-md-flex shadow-sm border-1 border-light mx-2">
            <i class="fas fa-plus"></i> &nbsp; Add Post
        </a>
        <!-- useable buttons -->
        @yield('nav_buttons')
    </div>
    <!-- main navbar right -->
    <div class="col-6 d-flex justify-content-end">
        <button
            wire:click='clear_cache'
            role="button"
            class="btn gray hover-gray rounded-4 nav-light-button bg-white mx-2"
        >
            <i class="fas fa-trash fa-lg"></i>
        </button>
        <button
            role="button"
            id="showProfileOffcanvas"
            data-bs-toggle="offcanvas"
            data-bs-target="#ProfileOffcanvas"
            aria-controls="ProfileOffcanvas"
            class="btn gray hover-gray rounded-4 nav-light-button bg-white mx-2"
        >
        <img src="{{ auth()->user()->avatar }}" width="35px" height="35px" alt="" class="rounded-circle">
        </button>
    </div>
</div>
