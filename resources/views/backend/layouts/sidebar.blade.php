<div class="sidebar {{ config('settings.sidebar_visibility') == 'visible' ? 'show-side' : '' }}" id="main-sidebar">
    <nav class="logo mb-3">
        <a href="#" class="nav_logo">
          <img src="{{ asset('img/logo.png') }}" alt="" class="nav_logo-icon">
            <img src="{{ asset('img/logo-name.png') }}" alt="" class="nav_logo-name">
        </a>
    </nav>
    <div class="py-2 mb-2 mt-0 sidebar_menu">
      <ul class="nav flex-column" id="nav_accordion">

        {{ mb::sidebar_menu() }}


      </ul>
    </div>
    <style>
        .nav-item{
            cursor: pointer;
        }
        .nav-item:hover{
            background-color: var(--ex-blue-50);
        }
    </style>
</div>
