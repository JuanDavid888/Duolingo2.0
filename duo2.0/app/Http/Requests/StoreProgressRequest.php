<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiar si necesitas lógica de autorización
    }

    public function rules(): array
    {
        return [
            'id_user' => ['required', 'exists:users,id'],
            'id_lesson' => ['required', 'exists:lessons,id'],
            'score' => ['required', 'numeric', 'between:0,100'], 
        ];
    }
}
