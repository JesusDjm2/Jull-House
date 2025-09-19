<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 text-dark fw-semibold mb-0">
                Editar Administrador
            </h2>
            <a href="{{ route('admin.index') }}" class="btn btn-danger btn-sm"> Volver</a>
        </div>
    </x-slot>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('admin.update', $admin) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{ old('name', $admin->name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{ old('email', $admin->email) }}" required>
                </div>

                <!-- Rol -->
                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="admin" {{ $admin->hasRole('admin') ? 'selected' : '' }}>Administrador</option>
                        <option value="cliente" {{ $admin->hasRole('cliente') ? 'selected' : '' }}>Cliente</option>
                        <option value="asistente" {{ $admin->hasRole('asistente') ? 'selected' : '' }}>Asistente</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">✏ Actualizar</button>
            </form>
        </div>
    </div>
</x-app-layout>
