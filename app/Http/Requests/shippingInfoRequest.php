<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shippingInfoRequest extends FormRequest
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
            'shipping' => 'required|array:firstName,lastName,phone,email,street,postalcade,city',
            'billing' => 'required|array:firstName,lastName,street,postalcade,city',
            'billing.*'=>'exclude_with:openbilling',
            '*.*' => 'required',
            '*.firstName' => 'max:64',
            '*.lastName' => 'max:64',
            '*.phone' => 'regex:/^\d{10,}$/|max:32',
            '*.email' => 'email|max:64',
            '*.street' => 'max:64',
            '*.postalcade' => 'regex:/^\d{4} ?[A-Z]{2}$/|max:16',
            '*.city' => 'max:64',
        ];
    }
    //messages in dutch
    public function messages(): array
    {
        return [
            'shipping.required' => 'Vul de velden in',
            'billing.required' => 'Vul de velden in',
            'required' => 'Dit veld is verplicht',
            'max' => 'Maximaal :max karakters',

            '*.phone.regex' => 'Vul een geldig telefoonnummer in',
            '*.email.email' => 'Vul een geldig email adres in',
            '*.postalcade.regex' => 'Vul een geldige postcode in',
        ];
    }
}
