<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProductValidation extends FormRequest
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
            "title" => "required",
            "description" => "required",
            "stock" => "required|integer",
            "price" => "required|decimal:0,2 ",
            "vat" => "required|integer",
            'img' => 'mimes:png,jpg,jpeg|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Een titel is verplicht.',
            'description.required' => 'Een introductie is verplicht.',
            'stock.required' => 'Een voorraad is verplicht.',
            'price.required' => 'Een prijs is verplicht.',
            'vat.required' => 'Een btw waarde is verplicht.',
            'img.file' => 'de file extensie is niet tegestaan'
        ];
    }
}
