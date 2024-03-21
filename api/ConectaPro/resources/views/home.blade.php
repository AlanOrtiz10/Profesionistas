<h1>LANDING</h1>


<nav id= "menu" class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('image/GT.png') }}" class="images" alt="..." height="36">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="">Inicio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                    Trabajos
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#servicios">Servicios</a></li>
                    <li><a class="dropdown-item" href="#reparaciones">Reparaciones</a></li>
                    <li><a class="dropdown-item" href="#modificaciones">Modificaciones</a></li>
                </ul>
            </li>
        <li class="nav-item">
            <a class="nav-link" href="#contacto">Contactanos</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
            data-bs-toggle="dropdown" aria-expanded="false">
            Account
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
            <li><a class="dropdown-item" href="{{route('register')}}">Registro</a></li>
        </ul>
            </ul>
        </div>
    </div>
</nav>
