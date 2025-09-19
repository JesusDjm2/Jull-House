<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 text-dark fw-semibold mb-0">
                Editar: {{ $ambiente->nombre }}
            </h2>
            <a href="{{ route('ambientes.show', $ambiente) }}" class="btn btn-danger">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="container my-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('ambientes.update', $ambiente) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $ambiente->nombre) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <input type="text" name="tipo" class="form-control" value="{{ old('tipo', $ambiente->tipo) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio (USD)</label>
                        <input type="number" name="precio" step="0.01" class="form-control" value="{{ old('precio', $ambiente->precio) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacidad</label>
                        <input type="number" name="capacidad" class="form-control" value="{{ old('capacidad', $ambiente->capacidad) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $ambiente->descripcion) }}</textarea>
                    </div>
                    @if($ambiente->images->count())
                        <h5>Galería actual</h5>
                        <div class="row mb-3">
                            @foreach($ambiente->images as $imagen)
                                <div class="col-md-3 mb-2">
                                    <div class="card">
                                        <img src="{{ asset($imagen->imagen) }}" class="card-img-top" alt="{{ $imagen->alt }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Subir nuevas imágenes -->
                    <div class="mb-3">
                        <label class="form-label">Agregar imágenes</label>
                        <input type="file" name="imagenes[]" multiple class="form-control">
                        <div class="form-text">Puedes subir varias imágenes nuevas (máx 4MB cada una)</div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
