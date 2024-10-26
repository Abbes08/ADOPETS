<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdopcionExitosa extends Model
{
    use HasFactory;

    // Especificar la tabla asociada
    protected $table = 'adopciones_exitosas';

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'adop_id'; // Aquí le indicamos que la clave primaria es 'adop_id'

    protected $fillable = [
        'mascota_id',
        'user_id',
        'reseña',
        'fecha_reseña',
        'imagen',
        'estado',
    ];

    // Relación con el modelo Mascota
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'mascota_id', 'mascota_id');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
 
    }
    protected $casts = [
        'fecha_reseña' => 'datetime', // Esto convierte el string a un objeto Carbon
    ];
}
