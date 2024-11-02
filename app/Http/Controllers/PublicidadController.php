<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use App\Models\User;
use Illuminate\Http\Request;

class PublicidadController extends Controller
{
   
    // Listar todas las publicidades
    public function index()
    {
        $publicidades = Publicidad::paginate(10);
        return view('publicidad.index', compact('publicidades'));
        
    }
   
   
    // Mostrar el formulario para crear una nueva publicidad
    public function create()
    {
        $users = User::all();
        return view('publicidad.create', compact('users'));
    }

    // Almacenar la nueva publicidad
   // Almacenar la nueva publicidad
public function store(Request $request)
{
    // Validación
    $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'nullable|numeric|min:0', // Hacer que el precio sea opcional
        'descripcion' => 'required|string|max:500',
        'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
        'fechaInicio' => 'required|date',
        'fechaFinal' => 'required|date|after_or_equal:fechaInicio',
        'user_id' => 'required|integer|exists:users,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'estado' => 'in:activo,inactivo',
    ]);

    // Manejo de la imagen
    $imagenPath = null;
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('publicidades', 'public');
    }

    // Crear publicidad
    Publicidad::create([
        'nombre' => $request->nombre,
        'precio' => $request->precio, // Se almacena el precio o null
        'descripcion' => $request->descripcion,
        'telefono' => $request->telefono,
        'fechaInicio' => $request->fechaInicio,
        'fechaFinal' => $request->fechaFinal,
        'user_id' => $request->user_id,
        'imagen' => $imagenPath,
        'estado' => $request->estado ?? 'activo',
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('publicidad.index')->with('success', 'Publicidad creada correctamente');
}

// Actualizar la publicidad
public function update(Request $request, $id)
{
    // Validación
    $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'nullable|numeric|min:0', // Hacer que el precio sea opcional
        'descripcion' => 'required|string|max:500',
        'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
        'user_id' => 'required|exists:users,id',
        'fechaInicio' => 'required|date',
        'fechaFinal' => 'required|date|after_or_equal:fechaInicio',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'estado' => 'required|string|max:200|in:activo,inactivo',
    ]);

    $publicidad = Publicidad::findOrFail($id);

    // Manejo de la imagen
    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('publicidades', 'public');
        $publicidad->imagen = $imagenPath;
    }

    // Actualizar publicidad
    $publicidad->update([
        'nombre' => $request->nombre,
        'precio' => $request->precio, // Se almacena el precio o null
        'descripcion' => $request->descripcion,
        'telefono' => $request->telefono,
        'fechaInicio' => $request->fechaInicio,
        'fechaFinal' => $request->fechaFinal,
        'user_id' => $request->user_id,
        'estado' => $request->estado,
    ]);

    return redirect()->route('publicidad.index')
                     ->with('success', 'Publicidad actualizada exitosamente.');
}
public function edit($id)
{
    // Obtener la publicidad con el ID proporcionado
    $publicidad = Publicidad::findOrFail($id);
    $users = User::all(); // Obtener todos los usuarios para el campo de selección

    // Retornar la vista de edición de publicidad
    return view('publicidad.edit', compact('publicidad', 'users'));
}



    // Eliminar una publicidad
    public function destroy($id)
    {
        $publicidad = Publicidad::findOrFail($id);
        $publicidad->delete();

        return redirect()->route('publicidad.index')
                         ->with('success', 'Publicidad eliminada exitosamente.');
    }

   

    public function mostrarPublicidad()
{
    $publicidad = Publicidad::paginate(8); // Paginar los resultados si hay muchos

    // Retornar la vista `vet` y pasar la variable `$publicidad`
    return view('vet', compact('publicidad'));
}

}

