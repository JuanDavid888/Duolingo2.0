<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_lesson' => ['required', 'exists:lessons,id'],
            'id_category' => ['required', 'exists:categories,id'],

            'word' => ['required', 'array'],
            'word.*' => ['required', 'string', 'max:255'],

            'file_path' => ['required', 'file', 'mimes:png,jpeg,jpg,svg,mp3', 'max:10240'],

            'mime_type' => ['required', 'in:image/png,image/jpeg,image/jpg,image/svg+xml,audio/mpeg'],

            'code' => ['required', 'string', 'unique:cards,code'],
        ];
    }

    /**
     * Custom attributes for validation errors.
     */
    public function attributes()
    {
        return [
            'id_lesson' => 'Leccion',
            'id_category' => 'Categoria',
            'word' => 'Palabra',
            'file' => 'Archivo',
            'mime_type' => 'Tipo de archivo',
            'code' => 'Codigo unico'
        ];
    }
}