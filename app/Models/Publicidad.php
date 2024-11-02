<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Asegúrate de importar el modelo User

class Publicidad extends Model
{
    use HasFactory;

    protected $table = 'publicidad'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    protected $fillable = [
        'nombre', 'precio', 'descripcion', 'telefono', 'user_id', 'fechaInicio', 'fechaFinal', 'estado', 'imagen'
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
