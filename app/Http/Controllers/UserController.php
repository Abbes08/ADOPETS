<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol; // Asegúrate de que esté importado correctamente
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users')); // Retorna la vista con la lista de usuarios
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
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

    // Crear el usuario con el rol asignado
    User::create([
        'name' => $validatedData['name'],
        'surname' => $validatedData['surname'],
        'gender' => $validatedData['gender'],
        'phone' => $validatedData['phone'],
        'address' => $validatedData['address'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => $validatedData['role'], // Asignar el rol
    ]);

    return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
}


    /**
     * Muestra los detalles de un usuario específico.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario para editar un usuario.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza un usuario específico.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario específico.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Muestra el formulario para asignar un rol a un usuario.
     */
    public function showAssignRoleForm($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Rol::all(); // Obtenemos todos los roles disponibles desde el modelo Rol

        return view('users.assign_role', compact('user', 'roles')); // Enviamos los roles y el usuario a la vista
    }

    /**
     * Asigna un rol a un usuario.
     */
    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Rol::findOrFail($request->input('role_id')); // Usamos Rol en lugar de Role

        // Asocia el rol al usuario
        $user->role()->associate($role);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Rol asignado correctamente.');
    }
}
