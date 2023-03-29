<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class AddCardToDeckRequest extends FormRequest
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
            'card_id' => ['required', 'int', 'min:1'],
            'deck_id' => ['required', 'int', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'card_id.required' => 'ID карты обезательно',
            'card_id.int' => 'ID карты не число',
            'card_id.min' => 'ID карты не должно быть меньше или равна нулю',
            'deck_id.required' => 'ID колоды обезательно',
            'deck_id.int' => 'ID колоды не число',
            'deck_id.min' => 'ID колоды не должно быть меньше или равна нулю',
        ];
    }
}
