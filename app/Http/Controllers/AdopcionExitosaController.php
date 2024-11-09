<?php

namespace App\Http\Controllers;

use App\Models\AdopcionExitosa;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdopcionExitosaController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->email === 'adminadopets@gmail.com') {
            // Administrador puede ver todas las adopciones exitosas
            $query = AdopcionExitosa::query();
        } else {
            // Usuarios normales solo ven sus propias adopciones exitosas
            $query = AdopcionExitosa::where('user_id', Auth::id());
        }
    
        $search = $request->input('search');
        $adopciones = $query->when($search, function ($query, $search) {
            return $query->whereHas('mascota', function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%");
            })->orWhere('reseña', 'like', "%{$search}%");
        })->get();
    
        if ($request->ajax()) {
            return response()->json($adopciones);
        }
    
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


