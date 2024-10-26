<?php

// app/Http/Controllers/InformativoPublicidadController.php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Illuminate\Http\Request;

class InformativoPublicidadController extends Controller
{
    public function create()
    {
        // Muestra la vista del formulario para la publicidad
        return view('informativo.publicidad.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
            'telefono' => 'required|string|max:15',
            'fechaInicio' => 'required|date',
            'fechaFinal' => 'required|date',
            'imagen' => 'nullable|image|max:2048',  // Imagen opcional
        ]);

        // Subir la imagen si se proporciona
        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('public/publicidad');
        }

        // Crear una nueva instancia de publicidad con los datos del formulario
        Publicidad::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'telefono' => $request->telefono,
            'user_id' => auth()->id(),  // Asocia la publicidad al usuario autenticado
            'fechaInicio' => $request->fechaInicio,
            'fechaFinal' => $request->fechaFinal,
            'estado' => 'pendiente',   // Puedes configurar un estado por defecto
            'imagen' => $rutaImagen,
        ]);

        return redirect('/informativo/publicidad')->with('success', 'Publicidad registrada con éxito');
    }
    
}
