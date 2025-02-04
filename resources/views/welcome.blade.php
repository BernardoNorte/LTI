<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mikrotik Controller</title>
    @vite('resources/sass/app.scss')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    @vite('resources/js/app.js')
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        
        <a class="navbar-brand ps-3" href="{{ route('neighbors') }}">Mikrotik Controller</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        
                        <div class="sb-sidenav-menu-heading">Interfaces</div>
                        <a class="nav-link" href="{{ route('interfaces') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cloud"></i></div>
                            All Interfaces
                        </a>
                        <a class="nav-link" href="{{ route('interfaces/wireless') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-wifi"></i></div>
                            Wireless Interfaces
                        </a>
                        <a class="nav-link" href="{{ route('interfaces/bridge') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-bridge"></i></div>
                            Bridge Interfaces
                        </a>
                        
                        <div class="sb-sidenav-menu-heading">Routes</div>
                        <a class="nav-link" href="{{ route('routes/static') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-arrows-to-circle"></i></div>
                            Static Routes
                        </a>
                        <div class="sb-sidenav-menu-heading">Wireless Security</div>
                        <a class="nav-link" href="{{ route('security.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            Security Profiles
                        </a>
                        <div class="sb-sidenav-menu-heading">DHCP</div>
                        <a class="nav-link" href="{{ route('dhcp') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            DHCP Servers
                        </a>
                        <div class="sb-sidenav-menu-heading">Addresses</div>
                        <a class="nav-link" href="{{ route('addresses') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cloud"></i></div>
                            All IP Addresses
                        </a>
                        <div class="sb-sidenav-menu-heading">Dns</div>
                        <a class="nav-link" href="{{ route('dns') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cloud"></i></div>
                            Dns Server
                        </a>
                        <div class="sb-sidenav-menu-heading">VPN</div>
                        <a class="nav-link" href="{{route('wireguard')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            WireGuard
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div id="layoutSidenav_content">
        
        @yield('main')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
