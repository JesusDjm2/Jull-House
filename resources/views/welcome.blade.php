@extends('layouts.padre')
@section('titulo', 'Bienvenidos a Jull House')
@section('contenido')
    <div class="container my-5">
        <h2 class="text-center mb-4">Nuestros Ambientes</h2>
        <div class="row">
            @forelse ($ambientes as $ambiente)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        @if ($ambiente->images->count())
                            <div id="carouselAmbiente{{ $ambiente->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($ambiente->images as $index => $imagen)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($imagen->imagen) }}" class="d-block w-100"
                                                alt="{{ $imagen->alt ?? $ambiente->nombre }}"
                                                style="height: 300px; object-fit: cover;" loading="lazy">
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
                                <span class="text-muted"><i class="fa-solid fa-user"></i> {{ $ambiente->capacidad }} personas</span>
                                <span class="fw-bold text-success">${{ number_format($ambiente->precio, 2) }}</span>
                            </div>
                            <p class="card-text">{{ $ambiente->descripcion }}</p>
                            <a href="{{ route('ambientes.show', $ambiente) }}" class="btn btn-primary btn-sm">Ver más</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">No hay ambientes registrados aún.</p>
            @endforelse
        </div>
    </div>
@endsection
