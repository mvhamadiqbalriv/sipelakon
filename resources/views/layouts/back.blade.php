<?php
if (isset($_GET['search'])) { ?>
<script>
    window.location.href = "{{ url($_GET['search'])}}";
</script>
<?php } ?>
@php
    $web = \App\Models\Web::findOrFail(1);
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        
        <!-- Title -->
        <title>@yield('title')</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{asset('assets/back/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/back/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/back/plugins/toastr/toastr.min.css')}}" rel="stylesheet">  

        <!-- Adds on -->
        @yield('css')

      
        <!-- Theme Styles -->
        <link href="{{asset('assets/back/css/lime.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/back/css/custom.css')}}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>

        <!--Sidebar-->
        <div class="lime-sidebar">
            <div class="lime-sidebar-inner slimscroll">
                <ul class="accordion-menu">
                    <?php
                        $url = explode("/",url()->current());
                    ?>
                    <li class="sidebar-title">
                        Back Apps
                    </li>
                    <li>
                        <a href="{{url('dashboard')}}" class="{{($url[3] == 'dashboard') ? 'active' : null}}"><i class="material-icons">dashboard</i>Dashboard</a>
                    </li>
                    <li>
                        <a href="{{url('web')}}" class="{{($url[3] == 'web') ? 'active' : null}}"><i class="material-icons">web</i>Profile Web</a>
                    </li>
                    <li>
                        <a href="{{url('users')}}" class="{{($url[3] == 'users') ? 'active' : null}}"><i class="material-icons">person_outline</i>Users</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons">aspect_ratio</i>Hak Akses<i class="material-icons has-sub-menu">keyboard_arrow_left</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('roles')}}" class="{{($url[3] == 'roles') ? 'active' : null}}">Roles</a>
                            </li>
                            <li>
                                <a href="{{url('permissions')}}" class="{{($url[3] == 'permissions') ? 'active' : null}}">Permissions</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="lime-header">
            <nav class="navbar navbar-expand-lg">
                <section class="material-design-hamburger navigation-toggle">
                    <a href="javascript:void(0)" class="button-collapse material-design-hamburger__icon">
                        <span class="material-design-hamburger__layer"></span>
                    </a>
                </section>
                <a class="navbar-brand" href="{{url('dashboard')}}">
                    <img src="{{Storage::url($web->logo)}}" style="object-fit: contain" alt="" alt="" width="80" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="material-icons">keyboard_arrow_down</i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="form-inline my-2 my-lg-0 search" id="searchForm" method="GET">
                        <input class="form-control mr-sm-2" id="searchInput" name="search" type="search" placeholder="Cari menu" aria-label="Search">
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li class="divider"></li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" onclick="event.preventDefault();
                                    this.closest('form').submit();"href="{{route('logout')}}">Log Out</a>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="lime-container">
            <div class="lime-body">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="lime-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <span class="footer-text text-center">2021 © inimahsumedang</span>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Javascripts -->
        <script src="{{asset('assets/back/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
        <script src="{{asset('assets/back/plugins/bootstrap/popper.min.js')}}"></script>
        <script src="{{asset('assets/back/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/back/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('assets/back/plugins/chartjs/chart.min.js')}}"></script>
        <script src="{{asset('assets/back/plugins/apexcharts/dist/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/back/plugins/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('assets/back/js/lime.min.js')}}"></script>

        <script>
            const sitemap = "{{url('/')}}";
            document.getElementById("searchInput").addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                    var searchVal = getElementById("searchInput").value;
                    window.location.href = sitemap+searchVal;
                    alert('WOI');
                    return false;
                }
            });
        </script>

        <!-- Adds on -->
        @yield('js')

    </body>
</html>