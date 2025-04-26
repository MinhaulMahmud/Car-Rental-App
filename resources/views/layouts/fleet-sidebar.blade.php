<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand">
            <span class="align-middle">Fleet Management</span>
        </a>
        <!-- Sidebar Toggle Button (Hamburger) -->
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Fleet Operations
            </li>
            <li class="sidebar-item {{ request()->routeIs('fleet.dashboard')?'active' : ''}}">
                <a class="sidebar-link" href="{{ route('fleet.dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('fleet.cars.create')?'active' : '' }}">
                <a class="sidebar-link" href="{{ route('fleet.cars.create')}}">
                    <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Add New Car</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('profile.edit')?'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profile.edit')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>