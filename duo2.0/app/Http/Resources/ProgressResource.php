<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Get the value of lang in the URL (ex. /api/category?lang=en&name=blabla)
        $locale = $request->query('lang', 'en');

        // Function to fetch localized value
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
            'score' => $this->score,
            
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],

            'lesson' => [
                'id' => $this->lesson->id,
                'title' => $getLocaleValue($this->lesson->title, $locale),
                'level' => $getLocaleValue($this->lesson->level, $locale),
            ],
        ];
    }
}
