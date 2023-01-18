<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rules;
class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255',"min:3"],
            'secondname' => ['required', 'string', 'max:255',"min:3"],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле Имя - обязательно.',
            'name.max' => 'Слишком длиное имя.',
            'name.min' => 'Слишком короткое имя.',
            'secondname.required' => 'Поле Фамилия - обязательно.',
            'secondname.max' => 'Слишком длиная фамилияю',
            'secondname.min' => 'Слишком короткая фамилия.',
            'email.required' => 'Поле Email - обязательно.',
            'email.email' => 'Не валидный Email',
            'email.unique' => 'Не валидный Email',
            'password.required' => 'Поле Пароль - обязательно.',
            'password.confirmed' => 'Пароли не совподают',
        ];
    }
}
