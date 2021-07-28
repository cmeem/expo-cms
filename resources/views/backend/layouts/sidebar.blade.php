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
        {{--  <li class="nav-item nav_active">
          <a class="nav-link nav_link d-flex align-items-center" href="#">
            <i class="fas fa-th nav_icon"></i>
            <span class="nav_name">Dashboard</span>
            <span class="badge rounded-pill bg-danger nav_badge" style="margin-left:auto;margin-right:12px;">9</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav_link d-flex align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#menu_item" href="#">
            <i class="fas fa-cog nav_icon"></i>
            <span class="nav_name">Settings</span>
            <i class="fas fa-chevron-right nav_arrow" style="margin-left:auto;margin-right:12px;"></i>
          </a>
          <ul id="menu_item" class="submenu submenu1 collapse" data-bs-parent="#nav_accordion">
            <li class="nav-item">
              <a class="nav-link nav_link" href="#">
                <i class="fas fa-th nav_icon"></i>
                <span class="nav_name">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav_link d-flex align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#sub_menu_item" href="#">
                <i class="fas fa-cog nav_icon"></i>
                <span class="nav_name">
                  settings
                </span>
                <i class="fas fa-chevron-right nav_arrow" style="margin-left:auto;margin-right:12px;"></i>
              </a>
              <ul id="sub_menu_item" class="submenu submenu2 collapse" data-bs-parent="#menu_item">
                <li class="nav-item">
                  <a class="nav-link nav_link" href="#">
                    <i class="fas fa-th fa-sm nav_icon"></i>
                    <span class="nav_name">sub 1</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav_link" href="#">
                    <i class="fas fa-th fa-sm nav_icon"></i>
                    <span class="nav_name">sub 2</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link nav_link" href="#">
                    <i class="fas fa-th fa-sm nav_icon"></i>
                    <span class="nav_name">sub 3</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link nav_link" href="#">
                <i class="fas fa-th nav_icon"></i>
                <span class="nav_name">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav_link" href="#">
                <i class="fas fa-th nav_icon"></i>
                <span class="nav_name">Dashboard</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="divider"></li>
        <li class="nav-item">
          <a class="nav-link nav_link d-flex align-items-center" href="#">
            <i class="fas fa-th nav_icon"></i>
            <span class="nav_name">Dashboard</span>
            <span class=" badge rounded-pill bg-danger nav_badge" style="margin-left:auto;margin-right:12px;">9</span>
          </a>
        </li>  --}}


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


