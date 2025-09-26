@extends('layouts.padre')
@section('titulo', 'Bienvenidos a Jull House')
@section('contenido')
    <section class="accommodation-header text-center text-white position-relative"
        style="background: url('{{ asset('img/fondo-principal.JPG') }}') center/cover no-repeat; height: 60vh;" >
        <div class="overlay position-absolute w-100 h-100 top-0 start-0" style="background: #0000001c;"></div>
        <div class="container position-relative h-100 d-flex align-items-center justify-content-center">
            <div class="header-content">
                <img src="{{ asset('img/Logo-vertical-blanco.png') }}" class="mb-4" alt="Logo Jull House 2" width="280px">
                {{-- <h1 class="display-4 fw-bold">JULL HOUSE</h1> --}}
                <p class="lead font-weight-bold"> Con presencia en los rincones más vibrantes de la ciudad,
                    <strong>Jull House</strong> combina comodidad moderna con el encanto local.
                    Sea cual sea tu plan, siempre habrá una de nuestras casas esperándote cerca.
                </p>
                <a href="#habitaciones" class="btn btn-light btn-lg">Descubre nuestras habitaciones</a>
            </div>
        </div>
    </section>

    <section id="habitaciones" class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-semibold">Habitaciones y suites</h2>
                    <p class="text-muted">Descubra toda nuestra variedad de encantadoras habitaciones y suites</p>
                </div>
            </div>

            <div class="row">
                @forelse ($ambientes as $ambiente)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            @if ($ambiente->images->count())
                                <div id="carouselAmbiente{{ $ambiente->id }}" class="carousel slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($ambiente->images as $index => $imagen)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset($imagen->imagen) }}" class="d-block w-100"
                                                    alt="{{ $imagen->alt ?? $ambiente->nombre }}"
                                                    style="height: 350px; object-fit: cover;" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselAmbiente{{ $ambiente->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                        <span class="visually-hidden">Anterior</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselAmbiente{{ $ambiente->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                        <span class="visually-hidden">Siguiente</span>
                                    </button>
                                </div>
                            @else
                                <img src="https://via.placeholder.com/400x250?text=Sin+Imagen" class="card-img-top"
                                    alt="Sin imagen" style="height: 300px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $ambiente->nombre }}</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted"><i class="fa fa-sm fa-user"></i> {{ $ambiente->capacidad }}
                                        personas</span>
                                    <span class="fw-bold text-success">${{ number_format($ambiente->precio, 2) }}</span>
                                </div>
                                <p class="card-text">{{ $ambiente->descripcion }}</p>
                                <a href="{{ route('ambiente.ver', $ambiente) }}"
                                    class="btn btn-primary mt-auto">Información detallada</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">No hay ambientes registrados aún.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Otra sección de contacto o reserva -->
    <section class="contacto py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3>Comuníquese con nosotros</h3>
                    <p>Reservas · 1 800 237 1236<br>Teléfono · +51 84 604 000<br>Dirección · Calle Plazoleta Nazarenas 337,
                        Cusco, Perú</p>
                    <a href="reservas.html" class="btn btn-outline-primary">Reservar ahora</a>
                </div>
            </div>
        </div>
    </section>
     <section class="contacto py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3>Comuníquese con nosotros</h3>
                    <p>Reservas · 1 800 237 1236<br>Teléfono · +51 84 604 000<br>Dirección · Calle Plazoleta Nazarenas 337,
                        Cusco, Perú</p>
                    <a href="reservas.html" class="btn btn-outline-primary">Reservar ahora</a>
                </div>
            </div>
        </div>
    </section>
     <section class="contacto py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3>Comuníquese con nosotros</h3>
                    <p>Reservas · 1 800 237 1236<br>Teléfono · +51 84 604 000<br>Dirección · Calle Plazoleta Nazarenas 337,
                        Cusco, Perú</p>
                    <a href="reservas.html" class="btn btn-outline-primary">Reservar ahora</a>
                </div>
            </div>
        </div>
    </section>
     <section class="contacto py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3>Comuníquese con nosotros</h3>
                    <p>Reservas · 1 800 237 1236<br>Teléfono · +51 84 604 000<br>Dirección · Calle Plazoleta Nazarenas 337,
                        Cusco, Perú</p>
                    <a href="reservas.html" class="btn btn-outline-primary">Reservar ahora</a>
                </div>
            </div>
        </div>
    </section>
@endsection
