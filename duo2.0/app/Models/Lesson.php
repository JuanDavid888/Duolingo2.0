<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;

    protected $table = "lessons";

    protected $fillable = [
        'id_category',
        'title',
        'description',
        'level'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function cards()
    {
        return $this->hasMany(Card::class, 'id_lesson');
    }
}
