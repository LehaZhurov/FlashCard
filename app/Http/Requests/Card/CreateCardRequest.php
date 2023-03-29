<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardRequest extends FormRequest
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
            'word' => ['required', 'min:1', 'string'],
            'gif' => ['required', 'min:1', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'word.required' => 'Слово обезательно',
            'word.string' => 'Cлово должно быть строкой',
            'word.min' => 'Длина слова не должно быть меньше или равна нулю',
            'gif.required' => 'Ссылка гифку обезательно',
            'gif.string' => 'Ссылка на гифку должна быть строкой',
            'gif.min' => 'Длина ссылки на гиф не должно быть меньше или равна нулю',
        ];
    }
}
