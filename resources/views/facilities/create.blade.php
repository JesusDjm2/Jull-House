<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark fw-semibold mb-0">
            {{ __('Nuevo Servicio') }}
        </h2>
    </x-slot>

    <div class="container my-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('facilities.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="extra" name="extra" value="1">
                        <label class="form-check-label" for="extra">Check si es servicio extra</label>
                    </div>

                    @php
                        $iconos_hoteleria = [
                            ['nombre' => 'Televisión', 'clase' => 'fa-solid fa-tv'],
                            ['nombre' => 'WiFi', 'clase' => 'fa-solid fa-wifi'],
                            ['nombre' => 'Aire acondicionado', 'clase' => 'fa-solid fa-fan'],
                            ['nombre' => 'Piscina', 'clase' => 'fa-solid fa-person-swimming'],
                            ['nombre' => 'Desayuno', 'clase' => 'fa-solid fa-mug-saucer'],
                            ['nombre' => 'Cama king', 'clase' => 'fa-solid fa-bed'],
                            ['nombre' => 'Estacionamiento', 'clase' => 'fa-solid fa-square-parking'],
                            ['nombre' => 'Gimnasio', 'clase' => 'fa-solid fa-dumbbell'],
                            ['nombre' => 'Baño privado', 'clase' => 'fa-solid fa-bath'],
                            ['nombre' => 'Servicio de habitación', 'clase' => 'fa-solid fa-bell-concierge'],
                            ['nombre' => 'Caja fuerte', 'clase' => 'fa-solid fa-vault'],
                            ['nombre' => 'Lavandería', 'clase' => 'fa-solid fa-shirt'],
                            ['nombre' => 'Mini bar', 'clase' => 'fa-solid fa-wine-glass'],
                            ['nombre' => 'Restaurante', 'clase' => 'fa-solid fa-utensils'],
                            ['nombre' => 'Spa', 'clase' => 'fa-solid fa-spa'],
                            ['nombre' => 'Sala', 'clase' => 'fa-solid fa-couch'],
                            ['nombre' => 'Comedor', 'clase' => 'fa-solid fa-chair'],
                            ['nombre' => 'Cocina', 'clase' => 'fa-solid fa-kitchen-set'],
                            ['nombre' => 'Baño', 'clase' => 'fa-solid fa-toilet'],
                            ['nombre' => 'Agua caliente y fría 24h', 'clase' => 'fa-solid fa-shower'],
                            ['nombre' => 'Implementos de baño (toalla, jabón)', 'clase' => 'fa-solid fa-soap'],
                            ['nombre' => 'Secador de cabello', 'clase' => 'fa-solid fa-wind'],
                            ['nombre' => 'TV LED 65” en la sala', 'clase' => 'fa-solid fa-tv'],
                            ['nombre' => 'Información turística', 'clase' => 'fa-solid fa-map-location-dot'],
                            ['nombre' => 'Depósito de maletas', 'clase' => 'fa-solid fa-suitcase-rolling'],
                            ['nombre' => 'Servicio de streaming', 'clase' => 'fa-solid fa-film'],
                            ['nombre' => 'Cocina equipada', 'clase' => 'fa-solid fa-kitchen-set'],
                        ];
                    @endphp

                    <div class="mb-3">
                        <label for="icono" class="form-label">Selecciona un ícono</label>
                        <div class="row">
                            @foreach ($iconos_hoteleria as $icono)
                                <div class="col-3 mb-2 text-center">
                                    <input type="radio" name="icono" id="icono_{{ $loop->index }}"
                                        value="{{ $icono['clase'] }}" class="btn-check">
                                    <label for="icono_{{ $loop->index }}" class="btn btn-outline-secondary w-100">
                                        <i class="{{ $icono['clase'] }} fa-2x mb-1"></i>
                                        <div class="small">{{ $icono['nombre'] }}</div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('facilities.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script para vista previa del ícono --}}
    <script>
        function updatePreview() {
            const input = document.getElementById('icono').value.trim();
            const preview = document.getElementById('iconPreview');
            preview.className = input;
        }
    </script>
</x-app-layout>
