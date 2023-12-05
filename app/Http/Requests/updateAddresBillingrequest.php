<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateAddresBillingrequest extends FormRequest
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
            'first_name_1' => 'required|max:255',
            'last_name_1' => 'required|max:255',
            'street_1' => 'required|max:255',
            'postal_code_1' => 'required|max:255',
            'city_1' => 'required|max:255',
        ];
    }
    //messages in dutch
    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'first_name_1.required' => 'voornaam is verplicht',
            'last_name_1.required' => 'achternaam is verplicht',
            'street_1.required' => 'straat is verplicht',
            'postal_code_1.required' => 'postcode is verplicht',
            'city_1.required' => 'stad is verplicht',
            'first_name_1.max' => 'voor naam mag niet groter zijn dat 255 karakters',
            'last_name_1.max' => 'achter naam mag niet groter zijn dat 255 karakters',
            'street_1.max' => 'straat mag niet groter zijn dat 255 karakters',
            'postal_code_1.max' => 'postcode mag niet groter zijn dat 255 karakters',
            'city_1.max' => 'stad mag niet groter zijn dat 255 karakters',
        ];
    }
}
