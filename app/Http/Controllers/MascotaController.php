<?php

namespace App\Http\Controllers;

use Carbon\Carbon; // Línea añadida para manejar fechas recientes
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index(Request $request)
{
    // Filtrar todas las mascotas del usuario o todas las mascotas si es administrador, sin importar el estado
    $query = Auth::user()->email === 'adminadopets@gmail.com'
        ? Mascota::query()  // El administrador ve todas las mascotas
        : Mascota::where('user_id', Auth::id());  // Usuarios normales ven solo sus propias mascotas

    // Filtro de búsqueda
    $search = $request->input('search');
    $mascotas = $query->when($search, function ($query, $search) {
        return $query->where('nombre', 'like', "%{$search}%")
                     ->orWhere('caracteristicas', 'like', "%{$search}%");
    })->paginate(10);

    // Devolver JSON en caso de petición AJAX para búsqueda en tiempo real
    if ($request->ajax()) {
        return response()->json([
            'mascotas' => $mascotas->items(),
            'links' => $mascotas->links()->render(),
        ]);
    }

    return view('mascotas.index', compact('mascotas'));
}


    


    public function create()
    {
        return view('mascotas.create');
    }

    public function store(Request $request)
    {
        // Validaciones
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
            'activo' => 'nullable|boolean', // Nuevo campo
        ]);
    
        // Procesar fotos
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
            'activo' => $request->input('activo', true), // Define el estado
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
    // Validación
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'edad' => 'required|integer',
        'sexo' => 'required|in:Macho,Hembra',
        'caracteristicas' => 'required|string',
        'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
        'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'activo' => 'nullable|boolean',
    ]);

    // Procesamiento de imágenes a eliminar
    if ($request->has('eliminar_fotos')) {
        foreach ($request->input('eliminar_fotos') as $foto) {
            \Storage::disk('public')->delete($foto); // Elimina del almacenamiento
            $mascota->fotos = array_diff($mascota->fotos, [$foto]); // Elimina de la lista
        }
    }

    // Procesar nuevas fotos
    $nuevasFotos = [];
    if ($request->hasFile('fotos')) {
        foreach ($request->file('fotos') as $foto) {
            $nuevasFotos[] = $foto->store('mascotas', 'public'); // Almacena en 'public'
        }
    }

    // Actualizar lista de fotos
    $mascota->fotos = array_merge($mascota->fotos ?? [], $nuevasFotos);

    // Actualizar otros campos
    $mascota->update([
        'nombre' => $validatedData['nombre'],
        'edad' => $validatedData['edad'],
        'sexo' => $validatedData['sexo'],
        'caracteristicas' => $validatedData['caracteristicas'],
        'telefono' => $validatedData['telefono'],
        'activo' => $request->input('activo', $mascota->activo),
        'fotos' => $mascota->fotos, // Asegura que el campo fotos esté actualizado
    ]);

    return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada correctamente.');
}

    



    public function destroy(Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada correctamente.');
    }

    public function mostrarMascotas(Request $request)
    {
        $recentDateThreshold = Carbon::now()->subDays(3); // Define el umbral para las mascotas recientes
        $filter = $request->input('filter');
    
        $mascotas = Mascota::where('activo', true)  // Solo muestra mascotas activas
            ->when($filter, function ($query, $filter) use ($recentDateThreshold) {
                if ($filter == 'Adopción') {
                    return $query->where('es_venta', false);
                } elseif ($filter == 'Venta') {
                    return $query->where('es_venta', true);
                } elseif ($filter == 'Recientes') {
                    return $query->where('created_at', '>=', $recentDateThreshold);
                }
            })
            ->paginate(8); // Usar paginación aquí
    
        // Agregar una bandera is_recent si la mascota es reciente
        $mascotas->getCollection()->transform(function ($mascota) use ($recentDateThreshold) {
            $mascota->is_recent = $mascota->created_at >= $recentDateThreshold;
            return $mascota;
        });
    
        return view('gallery', compact('mascotas'));
    }
    

    
    

    public function detalle($mascota_id)
    {
        $mascota = Mascota::findOrFail($mascota_id);
        return view('detalleMascota', compact('mascota'));
    }
}
