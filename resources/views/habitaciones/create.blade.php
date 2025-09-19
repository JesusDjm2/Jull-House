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
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <!-- Tipo -->
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <input type="text" name="tipo" class="form-control">
                            </div>

                            <!-- Precio -->
                            <div class="mb-3">
                                <label class="form-label">Precio (USD)</label>
                                <input type="number" name="precio" step="0.01" class="form-control">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
