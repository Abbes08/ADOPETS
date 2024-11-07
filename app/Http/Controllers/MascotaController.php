<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Mascota;

class MascotaController extends Controller
{
    public function index()
    {
        // Mostrar solo mascotas activas
        $mascotas = Mascota::where('activo', true)->get();
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        return view('mascotas.create');
    }

    public function store(Request $request)
    {
        // Validaciones dinámicas
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:Macho,Hembra',
            'caracteristicas' => 'required|string',
            'es_venta' => 'nullable|boolean',
            'raza' => 'nullable|string|required_if:es_venta,1',
            'precio' => 'nullable|numeric|required_if:es_venta,1',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
        ]);

        // Manejo de la subida de fotos
        $fotos = [];
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $fotos[] = $foto->store('mascotas', 'public');
            }
        }

        // Crear la mascota
        Mascota::create([
            'nombre' => $validatedData['nombre'],
            'edad' => $validatedData['edad'],
            'sexo' => $validatedData['sexo'],
            'caracteristicas' => $validatedData['caracteristicas'],
            'es_venta' => $validatedData['es_venta'] ?? 0,
            'raza' => $validatedData['raza'] ?? null,
            'precio' => $validatedData['precio'] ?? null,
            'fotos' => $fotos,
            'telefono' => $validatedData['telefono'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada correctamente.');
    }

    public function show(Mascota $mascota)
    {
        return view('mascotas.show', compact('mascota'));
    }

    public function edit(Mascota $mascota)
    {
        return view('mascotas.edit', compact('mascota'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:Macho,Hembra',
            'caracteristicas' => 'required|string',
            'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejo de las fotos para eliminar o añadir nuevas
        if ($request->has('eliminar_fotos')) {
            $fotosRestantes = array_diff($mascota->fotos, $request->eliminar_fotos);
            foreach ($request->eliminar_fotos as $foto) {
                \Storage::delete('public/' . $foto);
            }
            $mascota->fotos = $fotosRestantes;
        }

        if ($request->hasFile('fotos')) {
            $nuevasFotos = [];
            foreach ($request->file('fotos') as $foto) {
                $nuevasFotos[] = $foto->store('fotos', 'public');
            }
            $fotosExistentes = $mascota->fotos ?? [];
            $mascota->fotos = array_merge($fotosExistentes, $nuevasFotos);
        }

        $mascota->update([
            'nombre' => $validatedData['nombre'],
            'edad' => $validatedData['edad'],
            'sexo' => $validatedData['sexo'],
            'caracteristicas' => $validatedData['caracteristicas'],
            'es_venta' => $request->has('es_venta') ? 1 : 0,
            'raza' => $validatedData['raza'] ?? null,
            'precio' => $validatedData['precio'] ?? null,
            'fotos' => $mascota->fotos,
            'telefono' => $validatedData['telefono'],
        ]);

        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada correctamente.');
    }

    public function destroy(Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada correctamente.');
    }

    public function mostrarMascotas()
    {
        $mascotas = Mascota::where('activo', true)->paginate(9);
        return view('gallery', compact('mascotas'));
    }

    public function detalle($mascota_id)
    {
        $mascota = Mascota::findOrFail($mascota_id);
        return view('detalleMascota', compact('mascota'));
    }
}
