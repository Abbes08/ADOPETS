<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascotas; // Asegúrate de que este modelo esté importado

class InformativoMascotasController extends Controller
{
    public function create()
    {
        return view('informativo.mascotas.create');
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'edad' => 'required|integer',
        'sexo' => 'required|in:Macho,Hembra',
        'caracteristicas' => 'required|string',
        'es_venta' => 'required|boolean',
        'raza' => 'nullable|string|max:255',
        'precio' => 'nullable|numeric|min:0',
        'fotos' => 'required|array', // Asegúrate de que sea un array para las fotos
        'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para cada foto
        'whatsapp_link' => 'required|url',
    ]);

    // Procesar las imágenes y almacenarlas
    $fotos = [];
    if ($request->hasFile('fotos')) {
        foreach ($request->file('fotos') as $foto) {
            $fotos[] = $foto->store('public/mascotas');
        }
    }

    // Crear una nueva mascota en la base de datos
    Mascotas::create([
        'nombre' => $request->nombre,
        'edad' => $request->edad,
        'sexo' => $request->sexo,
        'caracteristicas' => $request->caracteristicas,
        'es_venta' => $request->es_venta,
        'raza' => $request->raza,
        'precio' => $request->precio,
        'fotos' => json_encode($fotos), // Almacenar las fotos como JSON
        'whatsapp_link' => $request->whatsapp_link,
        'user_id' => auth()->id(), // Suponiendo que el usuario está autenticado
    ]);

    return redirect('/informativo/mascotas')->with('success', 'Mascota registrada con éxito');
}

    public function show($mascota_id)
{
    $mascota = Mascotas::findOrFail($mascota_id); // Aquí debes buscar por mascota_id
    return view('mascotas.show', compact('mascota'));
}


}
