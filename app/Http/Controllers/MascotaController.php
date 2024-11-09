<?php

namespace App\Http\Controllers;
use Carbon\Carbon; // Agrega esta línea
use App\Models\Mascota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si el usuario autenticado es el administrador
        if (Auth::user()->email === 'adminadopets@gmail.com') {
            $query = Mascota::where('activo', true);
        } else {
            $query = Mascota::where('user_id', Auth::id())->where('activo', true);
        }
    
        // Filtrar por búsqueda si existe un término
        $search = $request->input('search');
        $mascotas = $query->when($search, function ($query, $search) {
            return $query->where('nombre', 'like', "%{$search}%")
                         ->orWhere('caracteristicas', 'like', "%{$search}%");
        })->get();
    
        // Retorna JSON en caso de petición AJAX para la búsqueda en tiempo real
        if ($request->ajax()) {
            return response()->json($mascotas);
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
            'telefono' => $request->telefono,
            'user_id' => Auth::id(),
            'activo' => true, // La mascota está activa por defecto
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
        // Validación de datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|integer',
            'sexo' => 'required|in:Macho,Hembra',
            'caracteristicas' => 'required|string',
            'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar fotos
        if ($request->hasFile('fotos')) {
            $nuevasFotos = [];
            foreach ($request->file('fotos') as $foto) {
                $nuevasFotos[] = $foto->store('fotos', 'public');
            }
            $mascota->fotos = array_merge($mascota->fotos ?? [], $nuevasFotos);
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
            'telefono' => $request->telefono,
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
        $recentDateThreshold = Carbon::now()->subDays(3);
        $filter = $request->input('filter');
    
        $mascotas = Mascota::where('activo', true)
            ->when($filter, function ($query, $filter) use ($recentDateThreshold) {
                if ($filter == 'Adopción') {
                    return $query->where('es_venta', false);
                } elseif ($filter == 'Venta') {
                    return $query->where('es_venta', true);
                } elseif ($filter == 'Recientes') {
                    // Agregar esta condición para filtrar solo las mascotas recientes
                    return $query->where('created_at', '>=', $recentDateThreshold);
                }
            })
            ->paginate(8)
            ->through(function ($mascota) use ($recentDateThreshold) {
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
