<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark fw-semibold mb-0">
            {{ __('Detalle del Servicio') }}
        </h2>
    </x-slot>

    <div class="container my-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $facility->nombre }}</p>
                <p><strong>Ícono:</strong>
                    <i class="bi {{ $facility->icono }} fs-4 text-primary"></i>
                    ({{ $facility->icono ?? 'No asignado' }})
                </p>

                <div class="mt-4">
                    <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
