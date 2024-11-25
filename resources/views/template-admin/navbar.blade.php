<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('assets/css/bootstrap.min.css') }}>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <title>Document</title>
    <style>
        .nav-item .active {
            background-color: #434446;
            font-weight: 900;
            color: white;
        }

        .custom-font {
            font-family: ;
        }
    </style>



</head>

<body>
    <div class="main-header">
        <div class="logo-header">
            <a href="/home" class="logo">
                UKKFALL
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
        </div>

        <nav class="navbar navbar-header navbar-expand-lg">
            <div class="container-fluid">

                {{--  <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                    <div class="input-group">
                        <input type="text" placeholder="Search ..." class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-search search-icon"></i>
                            </span>
                        </div>
                    </div>
                </form>  --}}
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                            aria-expanded="false">
                            <img src={{ asset('assets/img/profile.jpg') }} alt="user-img" width="36"
                                class="img-circle">
                            <span>{{ Auth::User()->name }}</a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <div class="user-box">
                                    <div class="u-img"><img src={{ asset('assets/img/profile.jpg') }} alt="user">
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::User()->name }}</h4>
                                        <p>{{ Auth::User()->email }}</p>
                                        <p class="text-muted"></p><a href="/profile"
                                            class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <div class="dropdown-divider"></div>
                            @if (Auth::user()->level === 'Admin')
                                <a class="dropdown-item" href="/logout">
                                @else
                                    <a class="dropdown-item" href="/member/logout">
                            @endif
                            <i class="fa fa-power-off"></i> Logout</a>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
            </div>
        </nav>
    </div>


    <div class="sidebar">
        <div class="scrollbar-inner sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src={{ asset('assets/img/profile.jpg') }}>
                </div>
                <div class="info">
                    <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::User()->name }}
                            <span class="user-level">{{ Auth::User()->level }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                        <ul class="nav">
                            <li>
                                <a href="/profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>

                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item">

                    @if (Auth::user()->level === 'Admin')
                        <a href="/home" class="nav-link">
                        @else
                            <a href="/member/home" class="nav-link">
                    @endif
                    <i class="la la-home"></i>
                    <p class="custom-font">Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->level === 'Admin')
                    <li class="nav-item">
                        <a href="/user" class="nav-link">
                            <i class="la la-group"></i>
                            <p class="custom-font">Management Users</p>
                        </a>
                    @else
                    <li class="nav-item">
                        <a href="/member/showmember" class="nav-link">
                            <i class="la la-group"></i>
                            <p class="custom-font">Management Members</p>
                        </a>
                        {{-- <a href="/member/user" class="nav-link"> --}}
                @endif

                </li>
                <li class="nav-item">
                    @if (Auth::user()->level === 'Admin')
                        <a href="/event" class="nav-link">
                        @else
                            <a href="/member/event" class="nav-link">
                    @endif
                    <i class="la la-calendar"></i>
                    <p class="custom-font">Management Events</p>
                    </a>
                </li>

                <li class="nav-item">
                    @if (Auth::user()->level === 'Admin')
                        <a href="/task" class="nav-link">
                        @else
                            <a href="/member/task" class="nav-link">
                    @endif
                    <i class="la la-tasks"></i>
                    <p class="custom-font">Management Tasks</p>
                    {{--  <span class="badge badge-count">6</span>  --}}
                    </a>
                </li>

                <li class="nav-item">
                    @if (Auth::user()->level === 'Admin')
                        <a href="/report" class="nav-link">
                        @else
                            <a href="/member/report" class="nav-link">
                    @endif
                    <i class="la la-tasks"></i>
                    <p class="custom-font">Management Reports</p>
                    {{--  <span class="badge badge-count">6</span>  --}}
                    </a>
                </li>


                <li class="nav-item">
                    @if (Auth::user()->level === 'Admin')
                        <a href="/detailReport" class="nav-link">
                        @else
                            <a href="/member/detailReport" class="nav-link">
                    @endif
                    <i class="la la-calendar"></i>
                    <p class="custom-font">Management Detail Reports</p>
                    {{-- <span class="badge badge-count">6</span> --}}
                    </a>
                </li>


            </ul>
        </div>
    </div>

    <div class="">

        @yield('content')

    </div>



</body>

</html>
<script>
    // Get all navigation links
    const navLinks = document.querySelectorAll('.nav-item a');

    // Get the current URL
    const currentUrl = window.location.href;

    // Iterate through each link and add the 'active' class if it matches the current URL
    navLinks.forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add('active');
        }
    });
</script>




<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
{{--  <script src="{{ asset ('assets/js/ready.min.js') }}"></script>  --}}