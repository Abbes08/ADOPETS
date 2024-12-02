<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Verificación de permisos de administrador
        if (Auth::user()->email !== 'adminadopets@gmail.com') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $search = $request->input('search');
        
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('surname', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->get();

        if ($request->ajax()) {
            return response()->json($users);
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|in:Masculino,Femenino,Otro',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:guest,premium', // Validación del rol
        ]);

        try {
            User::create([
                'name' => $validatedData['name'],
                'surname' => $validatedData['surname'],
                'gender' => $validatedData['gender'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
            ]);
            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al crear el usuario.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        try {
            $user->update($validatedData);
            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al actualizar el usuario.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Hubo un problema al eliminar el usuario.');
        }
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = true;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario habilitado correctamente.');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario deshabilitado correctamente.');
    }

    public function approvePremiumUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'premium') {
            $user->premium_approved = true;
            $user->save();

            return redirect()->route('users.index')->with('success', 'Usuario premium aprobado correctamente.');
        }

        return redirect()->route('users.index')->with('error', 'No se pudo aprobar el usuario premium.');
    }

    public function disapprovePremiumUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'premium') {
            $user->premium_approved = false;
            $user->save();

            return redirect()->route('users.index')->with('success', 'Usuario premium desaprobado correctamente.');
        }

        return redirect()->route('users.index')->with('error', 'No se pudo desaprobar el usuario premium.');
    }
}
