<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    @stack('customStyle')
    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style2.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg" style="height: 75px !important;"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="/" class="navbar-brand sidebar-gone-hide">SPA Testing</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i
                            class="fas fa-bars"></i></a>
                </div>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item "><a href="/" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item "><a href="/penyakit" class="nav-link">Penyakit</a>
                        </li>
                        @if (auth()->check())
                            <li class="nav-item "><a href="/diagnosa" class="nav-link">Diagnosa</a>
                            </li>
                            <li class="nav-item "><a href="/riwayat" class="nav-link">Riwayat</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <form class="form-inline ml-auto">

                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown" data-id="nav-atas">
                        @auth
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="/assets/img/avatar/login.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block" data-id="greetings">Hi, {{ auth()->user()->name }}
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('profile.user.index') }}" class="dropdown-item has-icon"
                                    data-id="profileEdit">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="dropdown-item has-icon text-danger" data-id="profileLogout">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="nav-link" data-id="nav-login">Login</a>
                        @endguest
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                @include('layouts.footer')
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>
    <script src="https://unpkg.com/@turf/turf@6.5.0/turf.min.js"></script>


    <!-- JS Libraies -->
    @stack('customPlugin')

    <!-- Page Specific JS File -->


    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    @stack('customScript')
</body>

</html>
