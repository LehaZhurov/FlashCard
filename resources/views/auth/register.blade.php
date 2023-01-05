@extends('layouts/app')
@section('title')
    Добро пожаловать
@endsection

@section('content')
    <div class="form_block" style='background-image: url(storage/img/world.png);'>
        <form method="POST" action="{{ route('register') }}">
            <h1>Регистрация</h1>
            @csrf
            <label for="name">Имя</label>
            <input type="text" id='name' name="name" placeholder="Имя" value="{{ old('name') }}">
            <x-input-error :messages="$errors->get('name')" />
            <label for="secondname">Фамилия</label>
            <input type="text" id='secondname' name="secondname" placeholder="Фамилия" value="{{ old('secondname') }}">
            <x-input-error :messages="$errors->get('secondname')" />
            <label for="email">Email</label>
            <input type="email" id='email' name="email" placeholder="Email">
            <x-input-error :messages="$errors->get('email')" />
            <label for="name">Пароль</label>
            <input type="password" id='password' name="password" placeholder="Пароль">
            <x-input-error :messages="$errors->get('password')" />
            <label for="password_confirmation">Повторите пароль</label>
            <input type="password" id='password_confirmation' name="password_confirmation" placeholder="Повторите пароль">
            <x-input-error :messages="$errors->get('password_confirmation')" />
            <div class="checkbox">
                <input type="checkbox" placeholder="Показать пароль">
                <label for="view_password">Показать пароль</label>
            </div>
            <button>Вперед</button>
        </form>
    </div>
@endsection




{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
