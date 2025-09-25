<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required|array'],
            'name.*' => ['required|string|max:255'],
            
            'description' => ['required|array'],
            'description.*' => ['required|string|max:1000'],
        ];
    }
}
