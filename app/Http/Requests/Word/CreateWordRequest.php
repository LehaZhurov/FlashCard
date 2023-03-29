<?php

namespace App\Http\Requests\Word;

use Illuminate\Foundation\Http\FormRequest;

class CreateWordRequest extends FormRequest
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
            'word' => ['required', 'string', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя обезательно',
            'name.string' => 'Имя должно быть строкой',
            'name.min' => 'Длина имени не должно быть меньше или равна нулю',
        ];
    }
}
