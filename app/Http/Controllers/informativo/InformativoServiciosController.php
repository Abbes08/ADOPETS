<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformativoServiciosController extends Controller
{

    public function create()
    {
        // Muestra la vista del formulario para la publicidad
        return view('informativo.servicio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'nombre' => 'required|string|max:255',
'descripcion' => 'nullable|string',
'estado' => 'required|boolean',
        ]);
    
    
        // Crear una nueva instancia de
        servicio::create([
           
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',  
           
        ]);
    
        return redirect('/informativo/servicio')->with('success', 'Adopcion exitosa registrada con éxito');
    }
}    
