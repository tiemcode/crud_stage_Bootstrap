<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "intro" => "required",
            "description" => "required",

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Een titel is verplicht.',
            'intro.required' => 'Een introductie is verplicht.',
            'description.required' => 'Een description is verplicht.',
        ];
    }
}
