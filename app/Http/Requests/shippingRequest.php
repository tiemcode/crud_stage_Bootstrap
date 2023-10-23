<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shippingRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => 'required',
            'street' => 'required',
            'postalcade' => 'required',
            'city' => 'required',
            // 'first_name_billing' => 'required',
            // 'last_name_billing' => 'required',
            // 'email_billing' => ['required', 'email'],
            // 'phone_number_billing' => 'required',
            // 'street_billing' => 'required',
            // 'postalcade_billing' => 'required',
            // 'city_billing' => 'required',
        ];
    }
    //messages
    public function messages(): array
    {
        return [
            'first_name.required' => 'Voornaam is verplicht',
            'last_name.required' => 'Achternaam is verplicht',
            'email.required' => 'Email is verplicht',
            'email.email' => 'Email moet een geldig email adres zijn',
            'phone_number.required' => 'Telefoon nummer is verplicht',
            'street.required' => 'Straat is verplicht',
            'postalcade.required' => 'Postcode is verplicht',
            'city.required' => 'Plaats is verplicht',
        ];
    }
}
