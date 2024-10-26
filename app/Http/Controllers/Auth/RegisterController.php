<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|in:Masculino,Femenino,Otro',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string|in:guest,premium', // Validación del rol
        ]);

        // Creación del nuevo usuario
        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Asignar el rol seleccionado por el usuario
        ]);

        // Redirigir después del registro
        return redirect()->route('login')->with('success', 'Registro creado correctamente.');
    }
}
