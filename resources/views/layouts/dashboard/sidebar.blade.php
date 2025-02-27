 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3">
     <nav class="navbar bg-light navbar-light">
         <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
             <h3 class="text-primary">
                 <img src="assets1/img/tg.gif" alt="Animated Icon"
                     style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; margin-right: 0.5rem;">
                 </i>PANEL
             </h3>
         </a>
         {{-- <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Jhon Doe</h6>
                <span>Admin</span>
            </div>
        </div> --}}
         <div class="navbar-nav w-100">
             <a href="{{ route('dashboard') }}"
                 class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                 <i class="fa fa-chart-bar me-2"></i>Dashboard
             </a>

             <div class="nav-item dropdown">
                 <a href="#" class="nav-link dropdown-toggle {{ request()->is('datasensor/*') ? 'active' : '' }}"
                     data-bs-toggle="dropdown">
                     <i class="fa fa-laptop me-2"></i>Data Sensor
                 </a>
                 <div class="dropdown-menu bg-transparent border-0">
                     <a href="{{ route('datasensor.datatemp') }}"
                         class="dropdown-item {{ request()->routeIs('datasensor.datatemp') ? 'active' : '' }}">Temperature</a>
                     <a href="{{ route('datasensor.datamq') }}"
                         class="dropdown-item {{ request()->routeIs('datasensor.datamq') ? 'active' : '' }}">Gas</a>
                     <a href="{{ route('datasensor.datarain') }}"
                         class="dropdown-item {{ request()->routeIs('datasensor.datarain') ? 'active' : '' }}">Hujan</a>
                 </div>
             </div>

             <a href="{{ route('users.index') }}"
                 class="nav-item nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                 <i class="bi bi-people-fill me-2"></i>Users
             </a>
             <a href="{{ route('logout') }}" class="nav-item nav-link">
                 <i class="bi bi-door-open-fill me-2"></i>Log Out
             </a>
         </div>

     </nav>
 </div>
 <!-- Sidebar End -->
