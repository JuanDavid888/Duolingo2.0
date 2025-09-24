<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'email_verified_at', 
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relación uno a muchos con roles
     */
    public function role()
    {
        return $this->belongsTo(Role::class);  // Un usuario tiene un solo rol
    }

    /**
     * Verificar si el usuario tiene un rol específico
     */
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }
}
