<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TarjetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'word' => is_array($this->word) && isset($this->word['sp'])
            ? $this->word['sp'] : '404',
            'file_path' => $this->file_path,
            'mime_type' => $this->mime_type,
            'code' => $this->code,
            'lesson' => $this->whenLoaded('lesson', function () {
                return [
                    'id' => $this->lesson->id,
                    'title' => $this->lesson->title
                ];
            }),
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name
                ];
            })
        ];
    }
}