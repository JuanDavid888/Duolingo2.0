<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CardUserFavorite extends Pivot
{
    protected $table = "card_user_favorites";

    protected $fillable = [
        'user_id',
        'card_id'
    ];
}