<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota; 
use App\Models\Transaccion; 
use Illuminate\Support\Facades\Auth; 

class TransaccionController extends Controller
{
    public function store(Request $request, $mascotaId)
{
    $mascota = Mascota::findOrFail($mascotaId);

    // Tipo de transacción: 'compra' si está en venta, 'adopcion' si no lo está
    $tipo = $mascota->es_venta ? 'compra' : 'adopcion';
    $precio = $mascota->es_venta ? $mascota->precio : 0;

    // Crear la transacción en la base de datos
    Transaccion::create([
        'mascota_id' => $mascota->mascota_id,
        'user_id' => Auth::id(),
        'tipo' => $tipo,
        'precio' => $precio,
        'fecha_transaccion' => now(),
    ]);

    // Marcar la mascota como inactiva
    $mascota->update(['activo' => false]);

    // Redireccionar al enlace de WhatsApp
    return redirect()->away($mascota->whatsapp_link);
}
}
