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
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>

                                <!-- Tipo -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo</label>
                                        <input type="text" name="tipo" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Precio -->
                                <div class="mb-3">
                                    <label class="form-label">Precio (USD)</label>
                                    <input type="number" name="precio" step="0.01" class="form-control">
                                </div>
                                </div>

                                <!-- Capacidad -->
                                <div class="mb-3">
                                    <label class="form-label">Capacidad</label>
                                    <input type="number" name="capacidad" class="form-control">
                                </div>

                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Características:</label>
                                    <div id="features-wrapper">
                                        <div class="feature">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="features[0][nombre]" placeholder="Ej: HAB 01">
                                            <input type="text" name="features[0][detalle]"
                                                class="form-control form-control-sm mb-2"
                                                placeholder="Ej: 01 CAMA MATRIMONIAL">
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-dark btn-sm text-white"
                                    onclick="addFeature()">Agregar característica</button>

                                <br><br>

                                <!-- Galería -->
                                <div class="mb-3">
                                    <label class="form-label">Fotos</label>
                                    <input type="file" name="imagenes[]" multiple class="form-control">
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
