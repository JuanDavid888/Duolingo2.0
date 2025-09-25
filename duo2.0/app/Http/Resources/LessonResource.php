<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Get the value of lang in the url (ex. /api/category?lang=en&name=blabla)
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
            'category' => new CategoryResource($this->whenLoaded('category')),

            'title' => $getLocaleValue($this->title, $locale),
            'description' => $getLocaleValue($this->description, $locale),
            'level' => $getLocaleValue($this->level, $locale),
        ];
    }
}
