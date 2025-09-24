<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "categories";

    protected $fillable = ['name', 'description'];

    protected $casts = [
        'published_at' => 'datetime',
        'name' => 'array',
        'description' => 'array',
        'deleted_at' => 'datetime'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'id_category');
    }
}
