<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required",
            "intro" => "required",
            "description" => "required",
            "cate" => "required|exists:categories,id",
            "date_publised" => "required|date",
            'file' => 'mimes:png'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Een titel is verplicht.',
            'intro.required' => 'Een introductie is verplicht.',
            'date_publised.required' => 'Een publicatiedatum verplicht.',
            'content.required' => 'Inhoud is verplicht.',
            'cate.required' => 'Een categorie is verplicht.',
            'cate.exists' => 'De geselecteerde categorie bestaat niet.',
            'date_publised.date' => 'De publicatiedatum moet een geldige datum zijn.',
            'file.file' => 'de file extensie is niet tegestaan probeer om een png te gebruiken'
        ];
    }
}
