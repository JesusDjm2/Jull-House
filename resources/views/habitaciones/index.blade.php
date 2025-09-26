<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 text-dark fw-semibold mb-0">
                {{ __('Lista de Ambientes') }}
            </h2>
            <a href="{{ route('ambientes.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Nuevo Ambiente
            </a>
        </div>
    </x-slot>
    <div class="container my-5">
        <!-- Mensajes -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabla de ambientes -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Precio (USD)</th>
                            <th>Capacidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $ambiente)
                            <tr>
                                <td>{{ $ambiente->nombre }}</td>
                                <td>{{ $ambiente->tipo }}</td>
                                <td>${{ number_format($ambiente->precio, 2) }}</td>
                                <td>{{ $ambiente->capacidad }}</td>
                                <td>
                                    <a href="{{ route('ambientes.show', $ambiente) }}"
                                        class="btn btn-sm btn-info">
                                        Ver
                                    </a>
                                    <a href="{{ route('ambientes.edit', $ambiente) }}"
                                        class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    <form action="{{ route('ambientes.destroy', $ambiente) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar este ambiente?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No hay ambientes registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
