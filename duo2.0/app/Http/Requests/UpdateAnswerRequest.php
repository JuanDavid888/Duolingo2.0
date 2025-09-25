<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnswerRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $answerId = $this->route('answer')->id ?? null;

        return [
            'card_code' => [
                'sometimes', 'string',
                Rule::unique('answers', 'card_code')->ignore($answerId)
            ],

            'id_card' => ['sometimes', 'exists:cards,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'card_code' => 'Código de la tarjeta',
            'id_card' => 'ID de la tarjeta',
        ];
    }
}
