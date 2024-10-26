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
    // Obtiene todas las mascotas
    $mascotas = Mascota::all(); 

    // Retorna la vista con las mascotas
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
            'estado' => true, // Por defecto, las reseñas estarán activas
        ]);

        return redirect()->route('adopciones_exitosas.index')->with('success', 'Adopción exitosa registrada correctamente.');
    }

    public function show($id)
{
    // Buscar la adopción exitosa por su ID
    $adopcion = AdopcionExitosa::with('mascota')->findOrFail($id);

    // Retornar la vista para mostrar los detalles
    return view('adopciones_exitosas.show', compact('adopcion'));
}

public function edit($id)
{
    // Buscar la adopción exitosa por su ID
    $adopcion = AdopcionExitosa::findOrFail($id);

    // Retornar la vista para editar la adopción exitosa
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

    // Buscar la adopción exitosa por su ID
    $adopcion = AdopcionExitosa::findOrFail($id);

    // Procesar la imagen si se sube una nueva
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('adopciones', 'public');
        $adopcion->imagen = $imagenPath;
    }

    // Actualizar la adopción exitosa
    $adopcion->update([
        'reseña' => $validatedData['reseña'],
        'fecha_reseña' => $validatedData['fecha_reseña'],
        'estado' => $validatedData['estado'],
    ]);

    return redirect()->route('adopciones_exitosas.index')->with('success', 'Adopción exitosa actualizada correctamente.');
}
public function destroy($id)
{
    // Buscar la adopción exitosa por su ID
    $adopcion = AdopcionExitosa::findOrFail($id);

    // Eliminar la adopción exitosa
    $adopcion->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('adopciones_exitosas.index')->with('success', 'Adopción exitosa eliminada correctamente.');
}
public function mostrarAdopcionExitosa()
{
    // Obtiene todas las publicidades, puedes agregar condiciones como 'estado' => activo
    $adopciones_exitosa = AdopcionExitosa::all();

    // Retorna la vista y le pasa los datos
    return view('blog', compact('adopciones_exitosa'));
}
}


