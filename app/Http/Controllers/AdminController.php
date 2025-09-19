<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get(); 
        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    // Guardar nuevo administrador
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,cliente,asistente',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $admin->assignRole($request->role);

        return redirect()->route('admin.index')->with('success', 'Administrador creado correctamente ✅');
    }

    // Mostrar formulario de edición
    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // Actualizar administrador
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$admin->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string|in:admin,cliente,asistente',
        ]);

        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);
        $admin->syncRoles([$request->role]);

        return redirect()->route('admin.index')->with('success', 'Administrador actualizado correctamente ✅');
    }

    // Eliminar administrador
    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Administrador eliminado correctamente ❌');
    }
}
