<?php

namespace App\Http\Controllers;
use App\Models\Publicidad;
use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $adoptionsCount = Mascota::where('es_venta', true)->where('activo', true)->count();
        $activePets = Mascota::where('activo', true)->count();
        $communityMembers = User::where('is_active', true)->count();

        return view('admin.home', compact('adoptionsCount', 'activePets', 'communityMembers'));
    }
        
        

    public function home()
{
    $publicidad = Publicidad::all(); // Asumiendo que tienes un modelo Publicidad
    return view('/', compact('publicidad'));
}
}
