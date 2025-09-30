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
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $ambiente->nombre) }}"
                                class="form-control @error('nombre') is-invalid @enderror" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tipo -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <input type="text" name="tipo" value="{{ old('tipo', $ambiente->tipo) }}"
                                    class="form-control @error('tipo') is-invalid @enderror">
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Precio -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Precio (USD)</label>
                                <input type="number" name="precio" value="{{ old('precio', $ambiente->precio) }}"
                                    step="0.01" class="form-control @error('precio') is-invalid @enderror">
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Capacidad -->
                        <div class="mb-3">
                            <label class="form-label">Capacidad</label>
                            <input type="number" name="capacidad" value="{{ old('capacidad', $ambiente->capacidad) }}"
                                class="form-control @error('capacidad') is-invalid @enderror">
                            @error('capacidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Descripción -->
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">{{ old('descripcion', $ambiente->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Características -->
                        <div class="mb-3">
                            <label class="form-label">Características:</label>
                            <div id="features-wrapper">
                                @php
                                    $features = old('features', $ambiente->features->toArray());
                                @endphp
                                @foreach ($features as $i => $feature)
                                    <div class="feature mb-2">
                                        <input type="text"
                                            class="form-control form-control-sm mb-2 @error("features.$i.nombre") is-invalid @enderror"
                                            name="features[{{ $i }}][nombre]"
                                            value="{{ $feature['nombre'] ?? '' }}" placeholder="Ej: HAB 01">

                                        <input type="text"
                                            class="form-control form-control-sm mb-2 @error("features.$i.detalle") is-invalid @enderror"
                                            name="features[{{ $i }}][detalle]"
                                            value="{{ $feature['detalle'] ?? '' }}"
                                            placeholder="Ej: 01 CAMA MATRIMONIAL">

                                        @error("features.$i.nombre")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error("features.$i.detalle")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark btn-sm text-white" onclick="addFeature()">Agregar
                            característica</button>
                        <br><br>
                        <!-- Galería -->
                        <div class="mb-3">
                            <label class="form-label">Fotos</label>
                            <input type="file" name="imagenes[]" multiple
                                class="form-control @error('imagenes.*') is-invalid @enderror">
                            <div class="form-text">Puedes subir varias imágenes (máx 4MB cada una)</div>
                            @error('imagenes.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-3">
                                @if ($ambiente->images->count())
                                    <h5>Galería actual</h5>
                                    <div class="row mb-3">
                                        @foreach ($ambiente->images as $imagen)
                                            <div class="col-md-3 mb-2">
                                                <div class="card">
                                                    <img src="{{ asset($imagen->imagen) }}" class="card-img-top"
                                                        alt="{{ $imagen->alt }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Botones -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
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
                    @if ($ambiente->images->count())
                        <h5>Galería actual</h5>
                        <div class="row mb-3">
                            @foreach ($ambiente->images as $imagen)
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
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
