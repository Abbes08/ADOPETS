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
            'es_venta' => 'nullable|boolean', // No es obligatorio, solo debe ser booleano
            'raza' => 'nullable|string|required_if:es_venta,1', // Obligatorio solo si es_venta es 1
            'precio' => 'nullable|numeric|required_if:es_venta,1', // Obligatorio solo si es_venta es 1
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
        $mascota = Mascota::create([
            'nombre' => $validatedData['nombre'],
            'edad' => $validatedData['edad'],
            'sexo' => $validatedData['sexo'],
            'caracteristicas' => $validatedData['caracteristicas'],
            'es_venta' => $validatedData['es_venta'] ?? 0, // Si no está marcado, es adopción
            'raza' => $validatedData['raza'] ?? null,
            'precio' => $validatedData['precio'] ?? null,
            'fotos' => $fotos,
            'telefono' => $request->telefono,
            'user_id' => Auth::id(),
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes estar autenticado para registrar una mascota.');
        }
        
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
    
        // Si se seleccionaron fotos para eliminar
        if ($request->has('eliminar_fotos')) {
            $fotosRestantes = array_diff($mascota->fotos, $request->eliminar_fotos);
    
            // Eliminar las imágenes del almacenamiento
            foreach ($request->eliminar_fotos as $foto) {
                \Storage::delete('public/' . $foto);
            }
    
            $mascota->fotos = $fotosRestantes;
        }
    
        // Manejar las nuevas fotos
        if ($request->hasFile('fotos')) {
            $nuevasFotos = [];
            foreach ($request->file('fotos') as $foto) {
                $ruta = $foto->store('fotos', 'public');
                $nuevasFotos[] = $ruta;
            }
    
            // Fusionar fotos nuevas con las existentes
            $fotosExistentes = $mascota->fotos ?? [];
            $mascota->fotos = array_merge($fotosExistentes, $nuevasFotos);
        }
    
        // Actualizar la mascota
        $mascota->update([
            'nombre' => $validatedData['nombre'],
            'edad' => $validatedData['edad'],
            'sexo' => $validatedData['sexo'],
            'caracteristicas' => $validatedData['caracteristicas'],
            'es_venta' => $request->has('es_venta') ? 1 : 0,
            'raza' => $validatedData['raza'] ?? null,
            'precio' => $validatedData['precio'] ?? null,
            'fotos' => $mascota->fotos,
            'telefono' => $request->telefono,
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
        // Obtener solo las mascotas activas y paginarlas
        $mascotas = Mascota::where('activo', true)->paginate(9);
        
        // Retornar la vista y pasarle los datos de mascotas activas
        return view('gallery', compact('mascotas'));
    }
    public function detalle($mascota_id)
    {
        $mascota = Mascota::findOrFail($mascota_id);
        return view('detalleMascota', compact('mascota'));
    }
    




}
