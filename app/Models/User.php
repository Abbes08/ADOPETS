<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'gender',
        'phone',
        'address',
        'email',
        'password',
        'role',  // Definido como role en lugar de role_id
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Método auxiliar para verificar roles fácilmente
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPremium()
    {
        return $this->role === 'premium';
    }
    
}
