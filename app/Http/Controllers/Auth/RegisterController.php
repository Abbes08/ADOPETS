<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use ReCaptcha\ReCaptcha;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'gender' => 'required|string|in:Masculino,Femenino,Otro',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string|in:guest,premium',
            'g-recaptcha-response' => 'required', // Asegúrate de validar el campo reCAPTCHA
        ]);
    
        $recaptcha = new ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET_KEY'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
    
        if (!$response->isSuccess()) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'El reCAPTCHA falló. Inténtalo nuevamente.']);
        }

    $isActive = $request->role === 'premium' ? false : true;

    $user = User::create([
        'name' => $request->name,
        'surname' => $request->surname,
        'gender' => $request->gender,
        'phone' => $request->phone,
        'address' => $request->address,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'is_active' => $isActive,
    ]);

    // Notificar al administrador si es premium
    if ($request->role === 'premium') {
        $this->notifyAdminOfNewPremiumUser($user);
    }

    return redirect()->route('login')->with('success', 'Registro creado correctamente. El administrador debe aprobar tu cuenta para que puedas iniciar sesión.');
}

protected function notifyAdminOfNewPremiumUser(User $user)
{
    $adminEmail = 'contactoadopets@gmail.com';
    $details = [
        'subject' => 'Nuevo usuario premium registrado',
        'message' => 'Un nuevo usuario premium ha solicitado registro y requiere su aprobación.',
        'user' => $user,
    ];

    try {
        \Mail::to($adminEmail)->send(new \App\Mail\NewPremiumUserNotification($details));
    } catch (\Exception $e) {
        \Log::error('Error al enviar notificación al administrador: ' . $e->getMessage());
    }
}

}