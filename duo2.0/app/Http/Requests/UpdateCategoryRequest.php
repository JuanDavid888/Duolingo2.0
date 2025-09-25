<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'array'],
            'name.*' => ['sometimes', 'string', 'max:255'],

            'description' => ['sometimes', 'array'],
            'description.*' => ['sometimes', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'description' => 'Descripción',
        ];
    }
}
