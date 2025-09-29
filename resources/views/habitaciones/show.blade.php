<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 text-dark fw-semibold mb-0">
                {{ $ambiente->nombre }}
            </h2>

            <!-- Botón regresar -->
            <a href="{{ route('ambientes.index') }}" class="btn btn-danger">
                Volver
            </a>
        </div>
    </x-slot>


    <div class="container my-5">
        <!-- Datos del ambiente en tabla -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th>Nombre</th>
                            <td>{{ $ambiente->nombre }}</td>
                        </tr>
                        <tr>
                            <th>Tipo</th>
                            <td>{{ $ambiente->tipo }}</td>
                        </tr>
                        <tr>
                            <th>Precio (USD)</th>
                            <td>${{ $ambiente->precio }}</td>
                        </tr>
                        <tr>
                            <th>Capacidad</th>
                            <td>{{ $ambiente->capacidad }}</td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td>{{ $ambiente->descripcion }}</td>
                        </tr>
                        @if ($ambiente->features->count())
                            <tr>
                                <th>Habitaciones</th>
                                <td>
                                    <ul class="mb-0">
                                        @foreach ($ambiente->features as $feature)
                                            <li>
                                                <strong>{{ $feature->nombre }}</strong>
                                                @if ($feature->detalle)
                                                    : {{ $feature->detalle }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Galería de imágenes -->
        @if ($ambiente->images->count())
            <h5 class="mb-3">Galería de imágenes</h5>
            <div class="row">
                @foreach ($ambiente->images as $imagen)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset($imagen->imagen) }}" class="card-img-top" alt="{{ $imagen->alt }}">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No hay imágenes para este ambiente.</p>
        @endif


    </div>
</x-app-layout>
