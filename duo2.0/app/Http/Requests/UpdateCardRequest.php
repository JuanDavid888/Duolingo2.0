<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Puedes hacer una autorización adicional si es necesario
        return true;
    }

    public function rules(): array
    {
        // Obtener el id de la card para excluirlo de la validación de "code" (evitar que el código se duplique)
        $cardId = $this->route('card')->id ?? null;

        return [
            'id_lesson' => ['sometimes', 'exists:lessons,id'],
            'id_category' => ['sometimes', 'exists:categories,id'],

            'word' => ['sometimes', 'array'],
            'word.*' => ['sometimes', 'string', 'max:255'],

            'file_path' => ['sometimes', 'file', 'mimes:png,jpeg,jpg,svg,mp3', 'max:10240'],

            'mime_type' => ['sometimes', 'in:image/png,image/jpeg,image/jpg,image/svg+xml,audio/mpeg'],

            'code' => ['sometimes', 'string', 'unique:cards,code,' . $cardId],
        ];
    }

    public function attributes()
    {
        return [
            'id_lesson' => 'Leccion',
            'id_category' => 'Categoria',
            'word' => 'Palabra',
            'file_path' => 'Archivo',
            'mime_type' => 'Tipo de archivo',
            'code' => 'Codigo único',
        ];
    }
}