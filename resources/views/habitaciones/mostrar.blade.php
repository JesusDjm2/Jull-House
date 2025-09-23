@extends('layouts.padre')
@section('titulo', $ambiente->nombre)
@section('contenido')
<div class="container">
    <h1>{{ $ambiente->nombre }}</h1>
    <p>{{ $ambiente->descripcion }}</p>
    <p><strong>Capacidad:</strong> {{ $ambiente->capacidad }} personas</p>
    <p><strong>Precio:</strong> ${{ number_format($ambiente->precio, 2) }}</p>

    {{-- Galería de imágenes --}}
    @if ($ambiente->images->count())
        @foreach ($ambiente->images as $imagen)
            <img src="{{ asset($imagen->imagen) }}" alt="{{ $ambiente->nombre }}" style="max-width:200px;">
        @endforeach
    @endif

    <hr>

    {{-- Formulario de reserva --}}
    <h3>Reservar este ambiente</h3>
    <form action="{{-- {{ route('reservas.store') }} --}}" method="POST">
        @csrf
        <input type="hidden" name="ambiente_id" value="{{ $ambiente->id }}">

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" required>
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Tu Nombre</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" required>
        </div>

        <button type="submit" class="btn btn-success">Reservar</button>
    </form>
</div>
@endsection
