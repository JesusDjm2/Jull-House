<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('habitaciones.index', compact('rooms'));
    }

    public function mostrar()
    {
        $ambientes = Room::all();

        return view('welcome', compact('ambientes'));
    }

    public function create()
    {
        return view('habitaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:100',
            'precio' => 'nullable|numeric|min:0',
            'capacidad' => 'nullable|integer|min:1',
            'descripcion' => 'nullable|string',
            'features.*.nombre' => 'required_with:features|string|max:255',
            'features.*.detalle' => 'nullable|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);
        $room = Room::create($request->only([
            'nombre',
            'tipo',
            'precio',
            'capacidad',
            'descripcion',
        ]));

        if ($request->has('features')) {
            foreach ($request->input('features') as $feature) {
                if (! empty($feature['nombre'])) {
                    $room->features()->create($feature);
                }
            }
        }

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreOriginal = $imagen->getClientOriginalName();
                $imagen->move(public_path('/img/galeria/'), $nombreOriginal);
                Galeria::create([
                    'room_id' => $room->id,
                    'imagen' => '/img/galeria/'.$nombreOriginal,
                    'alt' => $room->nombre,
                ]);
            }
        }

        return redirect()
            ->route('ambientes.index')
            ->with('success', 'Ambiente creado correctamente ✅');
    }

    public function show(Room $ambiente)
    {
        return view('habitaciones.show', compact('ambiente'));
    }

    public function ver($id)
    {
        $ambiente = Room::with('images')->findOrFail($id);
        $otrosAmbientes = Room::where('id', '!=', $ambiente->id)->get();

        return view('habitaciones.mostrar', compact('ambiente', 'otrosAmbientes'));
    }

    public function edit(Room $ambiente)
    {
        return view('habitaciones.edit', compact('ambiente'));
    }

    public function update(Request $request, Room $ambiente)
    {
        // ✅ Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:100',
            'precio' => 'nullable|numeric|min:0',
            'capacidad' => 'nullable|integer|min:1',
            'descripcion' => 'nullable|string',
            'features.*.nombre' => 'required_with:features|string|max:255',
            'features.*.detalle' => 'nullable|string|max:255',
            'imagenes.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // ✅ Actualizar datos principales
        $ambiente->update($request->only(['nombre', 'tipo', 'precio', 'capacidad', 'descripcion']));

       if ($request->filled('features')) {
        $ambiente->features()->delete();
        foreach ($request->input('features') as $feature) {
            if (! empty($feature['nombre'])) {
                $ambiente->features()->create($feature);
            }
        }
    }
        // ✅ Manejo de imágenes
        if ($request->hasFile('imagenes')) {
            // 1. Eliminar imágenes anteriores (físicamente y en DB)
            foreach ($ambiente->images as $imagen) {
                $path = public_path($imagen->imagen);
                if (file_exists($path)) {
                    unlink($path); // elimina físicamente
                }
                $imagen->delete(); // elimina de la BD
            }

            // 2. Subir nuevas imágenes
            foreach ($request->file('imagenes') as $imagen) {
                $nombreOriginal = $imagen->getClientOriginalName();
                $imagen->move(public_path('img/galeria'), $nombreOriginal);

                $ambiente->images()->create([
                    'alt' => $ambiente->nombre,
                    'imagen' => 'img/galeria/'.$nombreOriginal,
                ]);
            }
        }

        // ✅ Redirigir a index
        return redirect()->route('ambientes.index')
            ->with('success', 'Ambiente actualizado correctamente ✅');
    }

    public function destroy(Room $ambiente)
    {
        foreach ($ambiente->images as $imagen) {
            $path = public_path($imagen->imagen);
            if (file_exists($path) && is_file($path)) {
                unlink($path);
            }
        }
        $ambiente->images()->delete();
        $ambiente->delete();

        return redirect()
            ->route('ambientes.index')
            ->with('success', 'Ambiente eliminado correctamente ✅');
    }
}
