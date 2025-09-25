<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'card_code' => $this->card_code,
            'id_card' => $this->id_card,
            'card' => $this->whenLoaded('card', function () {
                return [
                    'id' => $this->card->id,
                    'word' => $this->card->word,
                    'code' => $this->card->code,
                ];
            })
        ];
    }
}
