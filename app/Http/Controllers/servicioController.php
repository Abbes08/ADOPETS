<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{
    public function index(Request $request)
{
    // Solo permitir acceso al administrador
    if (Auth::user()->email !== 'adminadopets@gmail.com') {
        abort(403, 'No tienes permiso para acceder a esta página.');
    }

    $search = $request->input('search');

    $servicios = Servicio::when($search, function ($query, $search) {
        return $query->where('nombre', 'like', "%{$search}%")
                     ->orWhere('descripcion', 'like', "%{$search}%");
    })->get();

    if ($request->ajax()) {
        return response()->json($servicios);
    }

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

        Servicio::create($request->all());

        return redirect()->route('servicio.index')->with('success', 'Servicio creado correctamente.');
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
        $servicio->update($request->all());

        return redirect()->route('servicio.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        $servicio->delete();

        return redirect()->route('servicio.index')->with('success', 'Servicio eliminado correctamente.');
    }
    public function mostrarServicio()
    {
        // Obtiene todas las publicidades, puedes agregar condiciones como 'estado' => activo
        $servicio = Servicio::all();

        // Retorna la vista y le pasa los datos
        return view('services', compact('servicio'));
    }
    public function showServicios()
{
    $servicio = Servicio::where('estado', true)->get(); // Solo selecciona los servicios activos
    return view('services', compact('servicio'));
}

}
