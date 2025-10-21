@extends('layouts.padre')
@section('titulo', $ambiente->nombre)
@section('contenido')
    {{-- CSS de FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    @if ($ambiente->images->count())
        <div id="ambienteCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($ambiente->images as $index => $imagen)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($imagen->imagen) }}" class="d-block w-100" alt="{{ $ambiente->nombre }}"
                            loading="lazy">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center">
                            <h1 class="display-4 fw-bold text-white text-shadow">{{ $ambiente->nombre }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#ambienteCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ambienteCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    @endif

    {{-- 🔹 Formulario de Reserva --}}
    <div class="container-fluid reserva-ambientes">
        <div class="container">
            <form action="{{-- {{ route('reservas.store') }} --}}" method="POST" class="row g-3 align-items-end">
                @csrf
                <input type="hidden" name="ambiente_id" value="{{ $ambiente->id }}">
                <div class="col-md-3">
                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control form-control-sm" name="fecha_ingreso" required>
                </div>
                <div class="col-md-3">
                    <label for="fecha_salida" class="form-label">Fecha de Salida</label>
                    <input type="date" class="form-control form-control-sm" name="fecha_salida" required>
                </div>
                <div class="col-md-2">
                    <label for="adultos" class="form-label">Adultos</label>
                    <input type="number" min="1" value="1" class="form-control form-control-sm" name="adultos"
                        required>
                </div>
                <div class="col-md-2">
                    <label for="ninos" class="form-label">Niños</label>
                    <input type="number" min="0" value="0" class="form-control form-control-sm" name="ninos">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit">Reservar</button>
                </div>
            </form>
        </div>
    </div>
    {{-- 🔹 Contenido principal + sidebar --}}
    <div class="container my-5">
        <div class="row espacio-ambientes">
            <div class="col-lg-8 pt-4">
                <h2 class="mb-4">{{ $ambiente->nombre }}</h2>
                <p>{{ $ambiente->descripcion }}</p>
                @if ($ambiente->features->count())
                    <h5 class="mt-4">
                        {{ $ambiente->features->count() === 1 ? 'Habitación' : 'Habitaciones' }}:
                    </h5>
                    <ul class="list-unstyled small mb-4">
                        @foreach ($ambiente->features as $feature)
                            <li class="mb-1">
                                <i class="fa-solid fa-bed text-primary me-2"></i>
                                <strong>{{ $feature->nombre }}</strong>
                                @if ($feature->detalle)
                                    – <span class="text-muted">{{ $feature->detalle }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if ($ambiente->facilities->where('extra', false)->count())
                    <h5 class="mt-4">Servicios incluidos:</h5>
                    <ul class="list-inline">
                        @foreach ($ambiente->facilities->where('extra', false) as $facility)
                            <li class="list-inline-item mb-3 me-3 text-center">
                                <i class="{{ $facility->icono }} fa-lg text-primary d-block mb-1"></i>
                                <span class="small d-block">{{ $facility->nombre }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                {{-- Galería elegante dentro del col-lg-8 --}}
                @if ($ambiente->images->count())
                    <h3 class="text-center my-4">Galería</h3>
                    <div class="row g-3">
                        @foreach ($ambiente->images as $imagen)
                            <div class="col-6 col-md-4">
                                <a href="{{ asset($imagen->imagen) }}" data-bs-toggle="modal"
                                    data-bs-target="#modalGaleria{{ $loop->index }}">
                                    <div class="gallery-item shadow-sm rounded overflow-hidden">
                                        <img src="{{ asset($imagen->imagen) }}" alt="{{ $ambiente->nombre }}"
                                            class="img-fluid w-100"
                                            style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                                    </div>
                                </a>
                            </div>
                            {{-- Modal para ver en grande --}}
                            <div class="modal fade" id="modalGaleria{{ $loop->index }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-body p-0">
                                            <img src="{{ asset($imagen->imagen) }}" class="img-fluid w-100 rounded"
                                                alt="{{ $ambiente->nombre }}" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <h4 class="mt-4 mb-3">Disponibilidad en calendario</h4>
                <div id="calendar" class="calendario"></div>
                @if (!empty($ambiente->mapa))
                    <h4 class="mt-4 mb-3">Ubicación</h4>
                    <div class="ratio ratio-16x9 rounded shadow-sm overflow-hidden">
                        {!! $ambiente->mapa !!}
                    </div>
                @else
                    <div class="alert alert-warning mt-3">
                        <i class="fa-solid fa-map-location-dot me-2"></i> Este ambiente aún no tiene un mapa configurado.
                    </div>
                @endif
            </div>
            {{-- Sidebar con otros ambientes --}}
            <div class="col-lg-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    @if ($ambiente->facilities->where('extra', true)->count())
                        <div class="mt-4">
                            <h6 class="fw-bold text-warning mb-2">
                                <i class="fa-solid fa-star text-warning me-1"></i> Servicios Extra
                            </h6>
                            <ul class="list-unstyled small">
                                @foreach ($ambiente->facilities->where('extra', true) as $extra)
                                    <li class="mb-2 d-flex align-items-center">
                                        <i class="{{ $extra->icono }} text-warning me-2"></i>
                                        {{ $extra->nombre }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h5 class="mb-3">Ambientes Jull House</h5>
                    <div class="d-flex flex-column gap-3">
                        @foreach ($otrosAmbientes as $otro)
                            <div class="card border-0 shadow-sm">
                                {{-- Imagen del ambiente --}}
                                @if ($otro->images->count())
                                    <img src="{{ asset($otro->images->first()->imagen) }}" class="card-img-top"
                                        alt="{{ $otro->nombre }}"
                                        style="height: 140px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                                @else
                                    <img src="{{ asset('img/default-room.jpg') }}" class="card-img-top" alt="Sin imagen"
                                        style="height: 140px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                                @endif
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-2">
                                        <i class="fa-solid fa-door-open me-1"></i> {{ $otro->nombre }}
                                    </h6>
                                    <p class="card-text small mb-2 text-muted">
                                        <i class="fa-solid fa-users me-1"></i> {{ $otro->capacidad }} personas <br>
                                        <i class="fa-solid fa-tag me-1"></i> {{ $otro->tipo }} <br>
                                        <i class="fa-solid fa-dollar-sign me-1"></i> {{ number_format($otro->precio, 2) }}
                                    </p>
                                    <a href="{{ route('ambientes.show', $otro->id) }}"
                                        class="btn btn-sm btn-outline-primary w-100">
                                        Ver detalles
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("✅ FullCalendar listo");
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) return console.error("No se encontró el div #calendar");

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                events: @json($eventos),
                eventColor: '#e63946',
                eventTextColor: '#fff'
            });
            calendar.render();
        });
    </script>

@endsection
