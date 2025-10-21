<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 text-dark fw-semibold mb-0">
                {{ __('Lista de Servicios') }}
            </h2>
            <a href="{{ route('facilities.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Nuevo Servicio
            </a>
        </div>
    </x-slot>

    <div class="container my-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                {{-- <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Icono</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($facilities as $facility)
                            <tr>
                                <td><i class="bi {{ $facility->icono }}"></i></td>
                                <td>{{ $facility->nombre }}</td>
                                <td>
                                    <a href="{{ route('facilities.show', $facility) }}" class="btn btn-sm btn-info">
                                        Ver
                                    </a>
                                    <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    <form action="{{ route('facilities.destroy', $facility) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar este servicio?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No hay servicios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table> --}}
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Icono</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($facilities as $facility)
                            <tr>
                                <td><i class="bi {{ $facility->icono }} fa-2x"></i></td>
                                <td>{{ $facility->nombre }}</td>
                                <td>
                                    @if ($facility->extra)
                                        <span class="badge bg-warning text-dark">Extra</span>
                                    @else
                                        <span class="badge bg-secondary">Incluido</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('facilities.show', $facility) }}"
                                        class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('facilities.edit', $facility) }}"
                                        class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('facilities.destroy', $facility) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar este servicio?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No hay servicios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
