<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exitosas extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'nombre',
        'Historia',
        'fotomascota',
        'Fecha',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}