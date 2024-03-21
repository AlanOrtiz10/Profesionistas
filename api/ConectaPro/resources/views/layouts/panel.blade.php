<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark custom-nav">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" >ConectaPro</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

   <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="{{ route('search') }}" method="GET">
        <div class="input-group">
            <input class="form-control" type="text" name="query" placeholder="Buscar entidad..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('config') }}">Configuración</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                </li>
            </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Principal</div>
                    <a class="nav-link" href="{{ route('admin') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Inicio
                    </a>
                    <div class="sb-sidenav-menu-heading">Servicios</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseServicios" aria-expanded="false" aria-controls="collapseServicios">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Servicios
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseServicios" aria-labelledby="headingServicios" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link"  href="{{ route('admin.service.index') }}">Servicios</a>
                            @auth
                            @if(auth()->user()->level_id == 1)

                            <a class="nav-link"  href="{{ route('admin.recommendation.index') }}">Recomendaciones</a>
                            @endif
                            @endauth
                        </nav>
                    </div>
                    @auth
                    @if(auth()->user()->level_id == 1)

                    <div class="sb-sidenav-menu-heading">Otros</div>
                    <a class="nav-link" href="{{ route('admin.category.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-sitemap"></i></div>
                        Categorías
                    </a>
                    @endif
                    @endauth

                    @auth
                    @if(auth()->user()->level_id == 1)

                    <a class="nav-link" href="{{ route('admin.speciality.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                        Especialidades
                    </a>
                    @endif
                    @endauth



                    @auth
                    @if(auth()->user()->level_id == 1)
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Usuarios
                    </a>
                    @endif
                    @endauth

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">{{auth()->user()->level->name }} Logueado</div>
                @auth
                {{ auth()->user()->name . ' ' . auth()->user()->surname }}
                @endauth
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        @yield('content')
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; ConectaPro 2024</div>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
</html>
