<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    use HasFactory;

    protected $table = 'publicidad';
    protected $primaryKey = 'id';

    protected $fillable = [
    'nombre', 'precio', 'descripcion', 'telefono', 'user_id', 'fechaInicio', 'fechaFinal', 'estado', 'imagen'
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}