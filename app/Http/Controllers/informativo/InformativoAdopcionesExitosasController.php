<?php

// app/Http/Controllers/InformativoAdopcionesExitosasController.php
namespace App\Http\Controllers;

use App\Models\AdopcionExitosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformativoAdopcionesExitosasController extends Controller
{
    public function create()
    {
        return view('informativo.adopciones_exitosa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,mascota_id',
            'user_id' => 'required|exists:users,id',
            'reseña' => 'required|string',
            'fecha_reseña' => 'required|date',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $rutaImagen = $request->hasFile('imagen') ? $request->file('imagen')->store('public/adopciones_exitosas') : null;

        AdopcionExitosa::create([
            'mascota_id' => $request->mascota_id,
            'user_id' => $request->user_id,
            'reseña' => $request->reseña,
            'fecha_reseña' => $request->fecha_reseña,
            'imagen' => $rutaImagen,
        ]);

        return redirect('/informativo/adopciones_exitosa')->with('success', 'Adopción exitosa registrada con éxito');
    }
}

