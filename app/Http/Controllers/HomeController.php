<?php

namespace App\Http\Controllers;
use App\Models\Publicidad;
use Illuminate\Http\Request;

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
        return view('admin.home');
        
            
        
        
}
    public function home()
{
    $publicidad = Publicidad::all(); // Asumiendo que tienes un modelo Publicidad
    return view('/', compact('publicidad'));
}
}
