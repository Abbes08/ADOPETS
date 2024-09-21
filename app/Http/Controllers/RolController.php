<?php

namespace App\Http\Controllers;

use App\Models\Rol; // Asegúrate de importar el modelo Rol
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Mostrar la lista de roles
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    // Mostrar el formulario para crear un nuevo rol
    public function create()
    {
        return view('roles.create');
    }

    // Guardar un nuevo rol
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|in:activo,inactivo',
        ]);

        try {
            Rol::create($request->all());
            return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el rol. Inténtalo de nuevo.');
        }
    }

    // Mostrar el formulario para editar un rol existente
    public function edit(Rol $rol)
    {
        return view('roles.edit', compact('rol'));
    }

    // Actualizar un rol existente
    public function update(Request $request, Rol $rol)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|in:activo,inactivo',
        ]);

        try {
            $rol->update($request->all());
            return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el rol. Inténtalo de nuevo.');
        }
    }

    // Eliminar un rol
    public function destroy(Rol $rol)
    {
        try {
            $rol->delete();
            return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el rol. Inténtalo de nuevo.');
        }
    }
}
