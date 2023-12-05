<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderInfo extends FormRequest
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
            'fullName' => 'required|max:255',
            'email' => 'required|email',
            'phoneNumber' => 'required',
        ];
    }
    //messages in dutch
    public function messages(): array
    {
        return [
            'fullName.required' => 'Naam is verplicht',
            'email.required' => 'Email is verplicht',
            'phoneNumber.required' => 'Telefoonnummer is verplicht',

        ];
    }
}
