<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicidadController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->email === 'adminadopets@gmail.com') {
            // Administrador puede ver todas las publicidades
            $query = Publicidad::query();
        } else {
            // Los usuarios normales solo ven sus propias publicidades
            $query = Publicidad::where('user_id', Auth::id());
        }
    
        // Filtrar por término de búsqueda
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->search . '%')
                  ->orWhere('telefono', 'like', '%' . $request->search . '%');
            });
        }
    
        $publicidades = $query->paginate(10);
    
        return view('publicidad.index', compact('publicidades'));
    }
    
    
    public function create()
    {
        // Verificar si el usuario es administrador para ver todos los usuarios o solo el suyo
        $users = Auth::user()->email === 'adminadopets@gmail.com'
                    ? User::all()  // Administrador ve todos los usuarios
                    : User::where('id', Auth::id())->get();  // Usuarios normales ven solo su propio registro

        return view('publicidad.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'nullable|numeric|min:0',
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
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'telefono' => $request->telefono,
            'fechaInicio' => $request->fechaInicio,
            'fechaFinal' => $request->fechaFinal,
            'user_id' => $request->user_id,
            'imagen' => $imagenPath,
            'estado' => $request->estado ?? 'activo',
        ]);

        return redirect()->route('publicidad.index')->with('success', 'Publicidad creada correctamente');
    }

    public function edit($id)
    {
        $publicidad = Publicidad::findOrFail($id);

        if (Auth::user()->email !== 'adminadopets@gmail.com' && $publicidad->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta publicidad.');
        }

        // Verificar si el usuario es administrador para ver todos los usuarios o solo el suyo
        $users = Auth::user()->email === 'adminadopets@gmail.com'
                    ? User::all()  // Administrador ve todos los usuarios
                    : User::where('id', Auth::id())->get();  // Usuarios normales ven solo su propio registro

        return view('publicidad.edit', compact('publicidad', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'descripcion' => 'required|string|max:500',
            'telefono' => 'required|string|max:15|regex:/^[0-9]{8,15}$/',
            'user_id' => 'required|exists:users,id',
            'fechaInicio' => 'required|date',
            'fechaFinal' => 'required|date|after_or_equal:fechaInicio',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado' => 'required|string|max:200|in:activo,inactivo',
        ]);

        $publicidad = Publicidad::findOrFail($id);

        if (Auth::user()->email !== 'adminadopets@gmail.com' && $publicidad->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta publicidad.');
        }

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('publicidades', 'public');
            $publicidad->imagen = $imagenPath;
        }

        $publicidad->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'telefono' => $request->telefono,
            'fechaInicio' => $request->fechaInicio,
            'fechaFinal' => $request->fechaFinal,
            'user_id' => $request->user_id,
            'estado' => $request->estado,
        ]);

        return redirect()->route('publicidad.index')->with('success', 'Publicidad actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $publicidad = Publicidad::findOrFail($id);

        if (Auth::user()->email !== 'adminadopets@gmail.com' && $publicidad->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta publicidad.');
        }

        $publicidad->delete();
        return redirect()->route('publicidad.index')->with('success', 'Publicidad eliminada exitosamente.');
    }

    public function mostrarPublicidad()
    {
        $publicidad = Publicidad::where('estado', 'activo')->paginate(8);
        return view('vet', compact('publicidad'));
    }
}
