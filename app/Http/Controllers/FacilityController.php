<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();

        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'icono' => 'nullable|string|max:255',
            'extra' => 'nullable|boolean',
        ]);

        Facility::create($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility creada correctamente.');
    }

    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'icono' => 'nullable|string|max:255',
            'extra' => 'nullable|boolean',
        ]);

        $facility->update($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility actualizada correctamente.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility eliminada correctamente.');
    }
}
