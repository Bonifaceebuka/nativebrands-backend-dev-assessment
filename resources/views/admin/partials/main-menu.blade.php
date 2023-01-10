<!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }} nav-item">
            <a href="{{route('admin.dashboard')}}"><i class="icon-home3"></i>
              <span data-i18n="nav.dash.main" class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="{{ Request::is('admin/categories*') ? 'active' : '' }} nav-item">
            <a href="{{route('admin.categories.index')}}"><i class="icon-stack-2"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Categories</span></a>
          </li>
          <li class="{{ Request::is('admin/videos*') ? 'active' : '' }} nav-item">
            <a href="{{route('admin.videos.index')}}"><i class="icon-video"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Videos</span></a>
          </li>
          {{-- <li class=" nav-item"><a href="#"><i class="icon-comments"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Comments</span></a>
          </li> --}}
          <li class="{{ Request::is('admin/plans*') ? 'active' : '' }} nav-item">
            <a href="{{route('admin.plans.index')}}"><i class="icon-banknote"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Plans</span></a>
          </li>
          <li class="{{ Request::is('admin/payments*') ? 'active' : '' }} nav-item">
            <a href="{{route('admin.payments.index')}}"><i class="icon-android-cart"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Payments</span></a>
          </li>
          <li class="{{ Request::is('admin/subscriptions*') ? 'active' : '' }} nav-item">
            <a href="{{route('admin.subscriptions.index')}}"><i class="icon-ios-albums-outline"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Subcriptions</span></a>
          </li>
          {{-- <li class=" nav-item"><a href="#"><i class="icon-users"></i>
            <span data-i18n="nav.page_layouts.main" class="menu-title">Users</span></a>
          </li> --}}
        </ul>
      </div>
      <!-- /main menu content-->