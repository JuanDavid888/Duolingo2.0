<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_user' => ['sometimes', 'exists:users,id'],
            'id_lesson' => ['sometimes', 'exists:lessons,id'],
            'score' => ['sometimes', 'numeric', 'between:0,100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_user' => 'Usuario',
            'id_lesson' => 'Lección',
            'score' => 'Puntaje',
        ];
    }
}
