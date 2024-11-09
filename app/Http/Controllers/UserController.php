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
