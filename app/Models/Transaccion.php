<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla
    protected $table = 'transacciones'; // <-- Esto asegura que la tabla correcta se utilice.

    protected $fillable = [
        'mascota_id',
        'user_id',
        'tipo',
        'precio',
        'fecha_transaccion',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id', 'mascota_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
