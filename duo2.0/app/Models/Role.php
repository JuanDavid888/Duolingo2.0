<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
    ];

    /**
     * Relación uno a muchos con usuarios
     */
    public function users()
    {
        return $this->hasMany(User::class);  // Un rol puede tener muchos usuarios
    }
}
