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
                                class="form-control form-control-sm @error('nombre') is-invalid @enderror" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tipo -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <input type="text" name="tipo" value="{{ old('tipo', $ambiente->tipo) }}"
                                    class="form-control form-control-sm @error('tipo') is-invalid @enderror">
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Precio -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Precio (USD)</label>
                                <input type="number" name="precio" value="{{ old('precio', $ambiente->precio) }}"
                                    step="0.01"
                                    class="form-control form-control-sm @error('precio') is-invalid @enderror">
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Capacidad -->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Capacidad</label>
                                <input type="number" name="capacidad"
                                    value="{{ old('capacidad', $ambiente->capacidad) }}"
                                    class="form-control form-control-sm @error('capacidad') is-invalid @enderror">
                                @error('capacidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Descripción -->
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                                rows="3">{{ old('descripcion', $ambiente->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mapa" class="form-label">Mapa (iframe o enlace de Google Maps):</label>
                            <textarea name="mapa" id="mapa" class="form-control form-control-sm @error('mapa') is-invalid @enderror"
                                rows="3" placeholder='Ejemplo: <iframe src="https://www.google.com/maps/embed?..."></iframe>'>{{ old('mapa', $ambiente->mapa ?? '') }}</textarea>

                            @error('mapa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div <div class="mb-3">
                        <label class="form-label">URL iCal (Airbnb / Booking)</label>
                        <input type="url" name="ical_url" value="{{ old('ical_url', $ambiente->ical_url ?? '') }}"
                            class="form-control form-control-sm @error('ical_url') is-invalid @enderror"
                            placeholder="URl ICal">
                        @error('ical_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Pega aquí la URL del calendario iCal de este ambiente.</small>
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
                                        value="{{ $feature['detalle'] ?? '' }}" placeholder="Ej: 01 CAMA MATRIMONIAL">

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
                    <button type="button" class="btn btn-dark btn-sm text-white" onclick="addFeature()">
                        Agregar habitación
                    </button>
                    <br><br>

                    <!-- Servicios disponibles -->
                    <div class="mb-4">
                        <label class="form-label d-block mb-2 fw-bold">Servicios incluidos:</label>
                        <div class="row">
                            @foreach ($iconos->where('extra', false) as $facility)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="form-check text-center">
                                        <input class="form-check-input" type="checkbox" name="facilities[]"
                                            value="{{ $facility->id }}" id="facility_{{ $facility->id }}"
                                            {{ in_array($facility->id, $facilitiesSeleccionadas) ? 'checked' : '' }}>
                                        <label class="form-check-label d-block btn btn-outline-secondary w-100"
                                            for="facility_{{ $facility->id }}">
                                            <i class="{{ $facility->icono }} fa-2x mb-1"></i>
                                            <div class="small">{{ $facility->nombre }}</div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Servicios extra -->
                    <div class="mb-4">
                        <label class="form-label d-block mb-2 fw-bold">Servicios extra disponibles:</label>
                        <div class="row">
                            @foreach ($iconos->where('extra', true) as $facility)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="form-check text-center">
                                        <input class="form-check-input" type="checkbox" name="facilities[]"
                                            value="{{ $facility->id }}" id="facility_extra_{{ $facility->id }}"
                                            {{ in_array($facility->id, $facilitiesSeleccionadas) ? 'checked' : '' }}>
                                        <label class="form-check-label d-block btn btn-outline-warning w-100"
                                            for="facility_extra_{{ $facility->id }}">
                                            <i class="{{ $facility->icono }} fa-2x mb-1 text-warning"></i>
                                            <div class="small fw-semibold">{{ $facility->nombre }}</div>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Galería -->
                    <div class="mb-3">
                        <label class="form-label">Fotos</label>
                        <input type="file" name="imagenes[]" multiple
                            class="form-control form-control-sm @error('imagenes.*') is-invalid @enderror">
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
            </form>
        </div>
    </div>
    </div>
    <script>
        let featureIndex = 1;

        function addFeature() {
            let wrapper = document.getElementById('features-wrapper');
            let div = document.createElement('div');
            div.classList.add('feature');
            div.innerHTML = `
            <input type="text" class="form-control form-control-sm mb-2" name="features[${featureIndex}][nombre]" placeholder="Ej: HAB 02">
            <input type="text" class="form-control form-control-sm mb-2" name="features[${featureIndex}][detalle]" placeholder="Ej: 01 CAMA QUEEN">
        `;
            wrapper.appendChild(div);
            featureIndex++;
        }
    </script>
</x-app-layout>
