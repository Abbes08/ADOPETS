<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exitosas; // Modelo exitosas
use App\Models\User; // Modelo User para seleccionar los usuarios
use Illuminate\Support\Facades\Storage;

class exitosasController extends Controller
{
    // Método para mostrar el formulario de creación
    public function create()
    {
        $users = User::all(); // Traemos todos los usuarios para el select
        return view('exitosas.create', compact('users'));
    }

    // Método para almacenar una nueva adopción exitosa
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idUser' => 'required',
            'nombre' => 'required|string',
            'Historia' => 'required|string',
            'fotomascota' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'Fecha' => 'required|date',
        ]);

        $imageName = time() . '.' . $request->fotomascota->extension();
        $request->fotomascota->storeAs('public/fotomascotas', $imageName);

        $exitosa = new exitosas();
        $exitosa->idUser = $request->idUser;
        $exitosa->nombre = $request->nombre;
        $exitosa->Historia = $request->Historia;
        $exitosa->fotomascota = $imageName;
        $exitosa->Fecha = $request->Fecha;
        $exitosa->save();

        return redirect()->route('exitosas.index')->with('success', 'Adopción exitosa creada correctamente.');
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $exitosa = exitosas::findOrFail($id); // Buscamos la adopción exitosa por id
        $users = User::all(); // Traemos todos los usuarios para el select
        return view('exitosas.edit', compact('exitosa', 'users'));
    }

    // Método para actualizar una adopción exitosa
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'idUser' => 'required',
            'nombre' => 'required|string',
            'Historia' => 'required|string',
            'fotomascota' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'Fecha' => 'required|date',
        ]);

        $exitosa = exitosas::findOrFail($id);
        $exitosa->idUser = $request->idUser;
        $exitosa->nombre = $request->nombre;
        $exitosa->Historia = $request->Historia;

        if ($request->hasFile('fotomascota')) {
            // Si se sube una nueva imagen, eliminar la anterior y guardar la nueva
            if ($exitosa->fotomascota) {
                Storage::delete('public/fotomascotas/' . $exitosa->fotomascota);
            }
            $imageName = time() . '.' . $request->fotomascota->extension();
            $request->fotomascota->storeAs('public/fotomascotas', $imageName);
            $exitosa->fotomascota = $imageName;
        }

        $exitosa->Fecha = $request->Fecha;
        $exitosa->save();

        return redirect()->route('exitosas.index')->with('success', 'Adopción exitosa actualizada correctamente.');
    }

    // Método para eliminar una adopción exitosa
    public function destroy($id)
    {
        $exitosa = exitosas::findOrFail($id);
        
        // Eliminar la imagen asociada
        if ($exitosa->fotomascota) {
            Storage::delete('public/fotomascotas/' . $exitosa->fotomascota);
        }
        
        $exitosa->delete();

        return redirect()->route('exitosas.index')->with('success', 'Adopción exitosa eliminada correctamente.');
    }

    // Método para mostrar todas las adopciones exitosas (Index)
    public function index()
    {
        $exitosas = exitosas::all();
        return view('exitosas.index', compact('exitosas'));
    }
}
