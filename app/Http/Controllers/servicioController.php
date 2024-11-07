<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicio.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        try {
            Servicio::create($request->all());
            return redirect()->route('servicio.index')->with('success', 'Servicio creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('servicio.index')->with('error', 'Hubo un problema al crear el servicio.');
        }
    }

    public function edit($id)
    {
        $servicio = Servicio::find($id);
        return view('servicio.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $servicio = Servicio::find($id);

        try {
            $servicio->update($request->all());
            return redirect()->route('servicio.index')->with('success', 'Servicio actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('servicio.index')->with('error', 'Hubo un problema al actualizar el servicio.');
        }
    }

    public function destroy($id)
    {
        $servicio = Servicio::find($id);

        try {
            $servicio->delete();
            return redirect()->route('servicio.index')->with('success', 'Servicio eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('servicio.index')->with('error', 'Hubo un problema al eliminar el servicio.');
        }
    }

    public function mostrarServicio()
    {
        $servicio = Servicio::all();
        return view('services', compact('servicio'));
    }
}

