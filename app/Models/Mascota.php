<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';

    // Especificar el nombre de la clave primaria
    protected $primaryKey = 'mascota_id';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'edad',
        'sexo',
        'caracteristicas',
        'es_venta',
        'raza',
        'precio',
        'fotos',
        'telefono',
        'user_id',
        'activo'
    ];

    protected $casts = [
        'fotos' => 'array', // El campo fotos será un array de nombres de archivos
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transacciones()
{
    return $this->hasMany(Transaccion::class, 'mascota_id', 'mascota_id');
}

}
