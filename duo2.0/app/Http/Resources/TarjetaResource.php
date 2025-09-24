<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get the value of lang in the url (ex. /api/card?lang=en&word=blabla)
        $locale = $request->query('lang', 'en');

        // Verify if exists and return, else null
        $getLocaleValue = function ($array, $locale) {
            if (is_array($array)) {
                if (isset($array[$locale]) && $array[$locale] !== null && $array[$locale] !== '') {
                    return $array[$locale];
                }
            }
            return null;
        };

        return [
            'id' => $this->id,
            'word' => $getLocaleValue($this->word, $locale),
            'file_path' => $this->file_path,
            'mime_type' => $this->mime_type,
            'code' => $this->code,
            'lesson' => $this->whenLoaded('lesson', function () {
                return [
                    'id' => $this->lesson->id,
                    'title' => $this->lesson->title,
                ];
            }),
            'category' => $this->whenLoaded('category', function () use ($locale, $getLocaleValue) {
                return [
                    'id' => $this->category->id,
                    'name' => $getLocaleValue($this->category->name, $locale),
                ];
            }),
        ];
    }
}
