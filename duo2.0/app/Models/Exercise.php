<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "exercises";

    protected $fillable = [
        'card_code',
        'answer_card_code'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'id_card');
    }

    public function answer()
    {
        return $this->hasOne(Answer::class, 'card_code', 'answer_card_code');
    }
}
