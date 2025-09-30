<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "cards";

    protected $fillable = [
        'id_lesson',
        'id_category',
        'word',
        'file_path',
        'mime_type',
        'code'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'word' => 'array',
        'deleted_at' => 'datetime'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'id_lesson');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'id_card');
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'card_code');
    }
}