<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Puedes agregar lógica de autorización aquí si la necesitas
        return true;
    }

    public function rules(): array
    {
        return [
            'id_category' => ['sometimes', 'exists:categories,id'],

            'title' => ['sometimes', 'array'],
            'title.*' => ['sometimes', 'nullable', 'string', 'max:255'],

            'description' => ['sometimes', 'array'],
            'description.*' => ['sometimes', 'nullable', 'string'],

            'level' => ['sometimes', 'array'],
            'level.en' => ['sometimes', 'nullable', 'string', Rule::in(['beginner', 'intermediate', 'advanced'])],
            'level.es' => ['sometimes', 'nullable', 'string', Rule::in(['principiante', 'intermedio', 'avanzado'])],
            
            'published_at' => ['sometimes', 'date', 'nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'id_category' => 'Categoria',
            'title' => 'Titulo',
            'description' => 'Descripcion',
            'level' => 'Nivel',
            'published_at' => 'Fecha de publicacion',
        ];
    }
}
