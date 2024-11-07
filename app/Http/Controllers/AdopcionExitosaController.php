<?php

namespace App\Http\Controllers;

use App\Models\AdopcionExitosa;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdopcionExitosaController extends Controller
{
    // Mostrar todas las adopciones exitosas del usuario logueado
    public function index()
    {
        $adopciones = AdopcionExitosa::where('user_id', Auth::id())->get();
        return view('adopciones_exitosas.index', compact('adopciones'));
    }

    public function create()
    {
        $mascotas = Mascota::all();
        return view('adopciones_exitosas.create', compact('mascotas'));
    }

    // Almacenar una nueva adopción exitosa
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mascota_id' => 'required|exists:mascotas,mascota_id',
            'reseña' => 'required|string',
            'fecha_reseña' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagenPath = null;
            if ($request->hasFile('imagen')) {
                $imagenPath = $request->file('imagen')->store('adopciones', 'public');
            }

            AdopcionExitosa::create([
                'mascota_id' => $validatedData['mascota_id'],
                'user_id' => Auth::id(),
                'reseña' => $validatedData['reseña'],
                'fecha_reseña' => $validatedData['fecha_reseña'],
                'imagen' => $imagenPath,
                'estado' => true,
            ]);

            return redirect()->route('adopciones_exitosas.index')->with('success', 'Adopción exitosa registrada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('adopciones_exitosas.index')->with('error', 'Hubo un problema al registrar la adopción.');
        }
    }

    public function show($id)
    {
        $adopcion = AdopcionExitosa::with('mascota')->findOrFail($id);
        return view('adopciones_exitosas.show', compact('adopcion'));
    }

    public function edit($id)
    {
        $adopcion = AdopcionExitosa::findOrFail($id);
        return view('adopciones_exitosas.edit', compact('adopcion'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reseña' => 'required|string',
            'fecha_reseña' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado' => 'required|boolean',
        ]);

        $adopcion = AdopcionExitosa::findOrFail($id);

        try {
            if ($request->hasFile('imagen')) {
                $imagenPath = $request->file('imagen')->store('adopciones', 'public');
                $adopcion->imagen = $imagenPath;
            }

            $adopcion->update([
                'reseña' => $validatedData['reseña'],
                'fecha_reseña' => $validatedData['fecha_reseña'],
                'estado' => $validatedData['estado'],
            ]);

            return redirect()->route('adopciones_exitosas.index')->with('success', 'Adopción exitosa actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('adopciones_exitosas.index')->with('error', 'Hubo un problema al actualizar la adopción.');
        }
    }

    public function destroy($id)
    {
        $adopcion = AdopcionExitosa::findOrFail($id);

        try {
            $adopcion->delete();
            return redirect()->route('adopciones_exitosas.index')->with('success', 'Adopción exitosa eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('adopciones_exitosas.index')->with('error', 'Hubo un problema al eliminar la adopción.');
        }
    }

    public function mostrarAdopcionExitosa()
    {
        $adopciones_exitosa = AdopcionExitosa::all();
        return view('blog', compact('adopciones_exitosa'));
    }
}


