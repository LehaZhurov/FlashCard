@extends('components/head')
@section('title')
    Регистрация
@endsection
<div id="work">
    @include('components/header')
    <div id="content">
        <div class="form_block" style='background-image: url(storage/img/world.png);'>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Вход</h1>
                <label for="email">Email</label>
                <input type="email" id='email' name="email" placeholder="Email" value="{{ old('email') }}">
                <x-input-error :messages="$errors->get('email')" />
                <label for="name">Пароль</label>
                <input type="password" id='password' name="password" placeholder="Пароль">
                <x-input-error :messages="$errors->get('password')" />
                <button>Вперед</button>
            </form>
        </div>
    </div>
    @include('components/footer')
