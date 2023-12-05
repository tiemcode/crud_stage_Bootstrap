<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class amountRequest extends FormRequest
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
            'amount' => 'required|numeric|min:1',
        ];

    }
    //messages in dutch
    public function messages(): array
    {
        return [
            'amount.required' => 'Het aantal is verplicht',
            'amount.numeric' => 'Het aantal moet een getal zijn',
            'amount.min' => 'Het aantal moet minimaal 1 zijn',
        ];
    }

}
