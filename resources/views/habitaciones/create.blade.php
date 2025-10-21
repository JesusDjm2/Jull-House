<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 text-dark fw-semibold mb-0">
                {{ __('Crear Ambiente Nuevo') }}
            </h2>
            <a href="{{ route('ambientes.index') }}" class="btn btn-sm btn-danger me-2">Cancelar</a>

        </div>
    </x-slot>


    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form action="{{ route('ambientes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Nombre -->
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control form-control-sm" required>
                                </div>

                                <!-- Tipo -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo:</label>
                                        <input type="text" name="tipo" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Precio -->
                                    <div class="mb-3">
                                        <label class="form-label">Precio (USD):</label>
                                        <input type="number" name="precio" step="0.01" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <!-- Capacidad -->
                                <div class="mb-3">
                                    <label class="form-label">Capacidad:</label>
                                    <input type="number" name="capacidad" class="form-control form-control-sm">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mapa (iframe o enlace de Google Maps):</label>
                                    <textarea name="mapa" class="form-control" rows="3">{{ old('mapa', $ambiente->mapa ?? '') }}</textarea>
                                </div>

                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label class="form-label">Descripción:</label>
                                    <textarea name="descripcion" class="form-control form-control-sm" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">URL iCal (Airbnb / Booking):</label>
                                    <input type="url" name="ical_url"
                                        value="{{ old('ical_url', $ambiente->ical_url ?? '') }}"
                                        class="form-control form-control-sm @error('ical_url') is-invalid @enderror"
                                        placeholder="URl ICal">
                                    @error('ical_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Pega aquí la URL del calendario iCal de este
                                        ambiente.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Habitaciones:</label>
                                    <div id="features-wrapper">
                                        <div class="feature">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="features[0][nombre]"
                                                placeholder="Número de habitacion, ejmeplo: Habitación 01, 02, 03">
                                            <input type="text" name="features[0][detalle]"
                                                class="form-control form-control-sm mb-2" placeholder="Tipo de cama">
                                        </div>
                                    </div>
                                </div>


                                <button type="button" class="btn btn-dark mb-4 btn-sm text-white"
                                    onclick="addFeature()">Agregar Habitación</button>
                                <br><br>

                                <!-- Servicios disponibles -->
                                <div class="mb-4">
                                    <label class="form-label d-block mb-2">Servicios incluidos:</label>
                                    <div class="row">
                                        @foreach ($iconos->where('extra', false) as $facility)
                                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                                <div class="form-check text-center">
                                                    <input class="form-check-input" type="checkbox" name="facilities[]"
                                                        value="{{ $facility->id }}" id="facility_{{ $facility->id }}">
                                                    <label
                                                        class="form-check-label d-block btn btn-outline-secondary w-100"
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
                                    <label class="form-label d-block mb-2">Servicios extra disponibles:</label>
                                    <div class="row">
                                        @foreach ($iconos->where('extra', true) as $facility)
                                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                                <div class="form-check text-center">
                                                    <input class="form-check-input" type="checkbox" name="facilities[]"
                                                        value="{{ $facility->id }}"
                                                        id="facility_extra_{{ $facility->id }}">
                                                    <label
                                                        class="form-check-label d-block btn btn-outline-warning w-100"
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
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Galería de Fotos:</label>
                                    <input type="file" name="imagenes[]" multiple
                                        class="form-control form-control-sm">
                                    <div class="form-text">Puedes subir varias imágenes (máx 4MB cada una)</div>
                                </div>

                                <!-- Botones -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
