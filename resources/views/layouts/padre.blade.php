<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jull House - @yield('titulo')</title>
    <link rel="icon" href="{{ asset('img/icono-jull-house.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/icono-jull-house.png') }}" type="image/x-icon">

    <!-- Para navegadores modernos -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   
</head>

<body class="d-flex flex-column min-vh-100">
    {{-- <div class="container-fluid" class="nav-info"></div> --}}
    <div class="container-fluid nav-info d-flex justify-content-center align-items-center">
        <a href="https://wa.me/51974732779" target="_blank" class="me-3 text-decoration-none text-white">
            <i class="fa fa-sm fa-phone"></i>+51 974 732 779
        </a>
        <span>|</span>
        <a href="mailto:reservas@jullhousecusco.com" class="ms-3 text-decoration-none text-white">
            <i class="fa-solid fa-sm fa-envelope"></i>reservas@jullhousecusco.com
        </a>
    </div>
    <nav id="mainNavbar" class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                {{-- Jull House --}} <img src="{{ asset('img/Logo-jull-house-blanco.png') }}" width="150px"
                    alt="Logo Jull house">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Menú de navegación">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                        viewBox="0 0 16 16">
                        <path stroke="white" stroke-linecap="round" stroke-width="2" d="M2 4h12M2 8h12M2 12h12" />
                    </svg>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ambientes.*') ? 'active' : '' }}" href="">
                            Ambientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Nosotros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Contacto
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            🌐 ES
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('lang/es') }}">Español</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('lang/en') }}">English</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- 🔹 Contenido principal -->
    <main class="flex-grow-1">
        @yield('contenido')
    </main>
    <!-- 🔹 Footer -->
    <footer class="bg-dark text-white pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row text-center text-md-start">

                <!-- Logo -->
                <div class="col-md-3 mb-4 mb-md-0 d-flex flex-column align-items-center align-items-md-start">
                    <img src="{{ asset('img/Logo-jull-house-blanco.png') }}" alt="Hotel Demo Logo" class="mb-3"
                        style="max-width: 130px;">
                    <p class="small text-white">Tu comodidad es nuestra prioridad.</p>
                </div>

                <!-- Contacto -->
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="text-uppercase fw-bold mb-3">Contacto</h6>
                    <p class="mb-1"><i class="fa-solid fa-phone me-2"></i> +51 974 732 779</p>
                    <p class="mb-1"><i class="fa-solid fa-envelope me-2"></i> reservas@jullhousecusco.com</p>
                    {{-- <p class="mb-0"><i class="fa-solid fa-location-dot me-2"></i> Av. Principal 123</p> --}}
                </div>

                <!-- Políticas -->
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="text-uppercase fw-bold mb-3">Información</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Políticas de reserva</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Libro de reclamaciones</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Términos y condiciones</a></li>
                    </ul>
                </div>

                <!-- Redes sociales -->
                <div class="col-md-3">
                    <h6 class="text-uppercase fw-bold mb-3">Síguenos</h6>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3">
                        <a href="https://www.facebook.com/AlojamientoJullHouse" target="_blank"
                            class="text-white fs-5"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" target="_blank" class="text-white fs-5"><i
                                class="fa-brands fa-instagram"></i></a>
                        <a href="#" target="_blank" class="text-white fs-5"><i
                                class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://wa.me/51974732779" target="_blank" class="text-white fs-5"><i
                                class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <!-- Copyright -->
            <div class="text-center">
                <small>&copy; {{ date('Y') }} Jull House. Todos los derechos reservados.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener("scroll", function() {
            const navbar = document.getElementById("mainNavbar");

            if (window.scrollY > 50) {
                if (!navbar.classList.contains("navbar-scrolled")) {
                    navbar.classList.add("fixed-top", "navbar-scrolled");
                }
            } else {
                navbar.classList.remove("fixed-top", "navbar-scrolled");
            }
        });
    </script>
</body>

</html>
