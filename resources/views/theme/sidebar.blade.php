    <!-- Sidebar -->
    <ul class="pr-0 navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-book"></i>
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
            <a class="nav-link text-right" href="{{route('dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>لوحة التحكم</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/ad*') ? 'active' : '' }}">
            <a class="nav-link text-right" href=" {{ route('ad.index') }} ">
                <i class="fas fa-book-open"></i>
                <span>الإعلانات</span>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/category*') ? 'active' : '' }}">
            <a class="nav-link text-right" href=" {{ route('category.index') }} ">
                <i class="fas fa-folder"></i>
                <span>التصنيفات</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ request()->is('admin/user*') ? 'active' : '' }}">
            <a class="nav-link text-right" href="{{ route('user.index') }}">
                <i class="fas fa-pen-fancy"></i>
                <span>المستخدمون</span>
            </a>
        </li>

        

        <!-- Nav Item - Tables -->
        <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
            <a class="nav-link text-right" href="{{-- {{ route('users.index') }} --}}">
                <i class="fas fa-users"></i>
                <span>الأدوار</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
