<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.dashboard.head')
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0 ">
        <!-- Spinner Start -->
        @include('layouts.dashboard.loader')
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('layouts.dashboard.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">

                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="https://www.linkedin.com/in/nanar-tyrta-prayuga-9a8444296/" class="nav-link" target="_blank">
                            <i class="bi bi-linkedin" style="color: white;"></i>
                        </a>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="https://github.com/nanar123" class="nav-link" target="_blank">
                            <i class="bi bi-github" style="color: white;"></i>
                        </a>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            {{-- <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;"> --}}
                            <span class="d-none d-lg-inline-flex">{{auth()->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            {{-- <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a> --}}
                            <a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            @yield('isi content')

            <!-- Footer Start -->
            @include('layouts.dashboard.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        @include('layouts.dashboard._foot')

        @stack('scripts')
</body>


</html>
