<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia esto si necesitas autorización
    }

    public function rules(): array
    {
        return [
            'id_category' => ['required', 'exists:categories,id'],

            'title' => ['required', 'array'],
            'title.en' => ['required', 'string', 'max:255'],
            'title.es' => ['required', 'string', 'max:255'],

            'description' => ['required', 'array'],
            'description.en' => ['required', 'string'],
            'description.es' => ['required', 'string'],

            'level' => ['required', 'array'],
            'level.en' => ['required', Rule::in(['beginner', 'intermediate', 'advanced'])],
            'level.es' => ['required', Rule::in(['principiante', 'intermedio', 'avanzado'])],
        ];
    }
}
