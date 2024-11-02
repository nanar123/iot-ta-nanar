<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">

    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <img src="assets1/img/nty.png" alt="Icon" style="width: 24px; height: 24px; margin-right: 0.5rem;">
                Panel IoT
            </h3>
        </a>

        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}"
                class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <a href="{{ route('datasensor') }}"
                class="nav-item nav-link {{ request()->routeIs('datasensor') ? 'active' : '' }}">
                <i class="bi bi-thermometer me-2"></i>Data Sensor
            </a>

            <a href="{{ route('aktu') }}" class="nav-item nav-link {{ request()->routeIs('aktu') ? 'active' : '' }}">
                <i class="bi bi-app-indicator me-2"></i>Aktuator
            </a>

            <a href="{{ route('users.index') }}"
                class="nav-item nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Pengguna
            </a>

            {{-- <div class="nav-item dropdown">
                <a href="{{ route('login') }}"
                    class="nav-link dropdown-toggle {{ request()->routeIs('') ? 'active' : '' }}"
                    data-bs-toggle="dropdown">
                    <i class="far fa-file-alt me-2"></i>Pages
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                    <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                    <a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
                </div>
            </div> --}}
        </div>

    </nav>
</div>
<!-- Sidebar End -->
