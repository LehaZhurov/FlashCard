@extends('layouts/app')
@section('title')
    Добро пожаловать
@endsection
@section('header')
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                                this.closest('form').submit();">
            {{ __('Выйти') }}
        </x-dropdown-link>
    </form>
    </div>
    <div id='balance'>
        <span title='Буквопыль использутся для создания новых карт'>30000</span>
        <i class='bx bxs-vial'></i>
    </div>
@endsection
@section('content')
    <div class="tabs">
        <input type="radio" name="tabs" id="tab-first" checked>
        <label for="tab-first">
            <p>Карты</p>
        </label>
        <input type="radio" name="tabs" id="tab-second">
        <label for="tab-second">
            <p>Колоды</p>
        </label>
        <div id="tab-content-1" class="tab-content">
            <div>
                <h1>Карты 5/5</h1>
            </div>
            <div class="center-deck">
                <div id="deck-card" class='deck'>
                    <div class="card legend">
                        <div class="card-gif">
                            <img src="https://media4.giphy.com/media/8IyJweC7qiNu2716vT/giphy.gif?cid=ecf05e478nacvxrqo86h9cfkha7c2d2bcccdfioflaye3lr2&rid=giphy.gif&ct=s"
                                alt="">
                        </div>
                        <div class="card-text">
                            <p>Create a new flashcard</p>
                            <p>Создать новую карточку</p>
                        </div>
                        <div class="card-option">
                            <div class="button-group-column">
                                <button>Создать</button>
                            </div>
                        </div>
                    </div>
                    <div class="card rare">
                        <div class="card-gif">
                            <img src="https://media4.giphy.com/media/uFEL9XqI2kXKyeHmAy/giphy.gif?cid=ecf05e477h8qxqcs41x35a1irvuqp5x9ovsmix0cpzgacwrw&rid=giphy.gif&ct=s"
                                alt="">
                        </div>
                        <div class="card-text">
                            <p>add</p>
                            <p>добавить</p>
                        </div>
                        <div class="card-option">
                            <div class="button-group-column">
                                <button class='danger'>Распылить</button>
                                <button>В колоду</button>
                            </div>
                        </div>
                    </div>
                    <div class="card epic">
                        <div class="card-gif">

                            <img src="https://neversaynever0304.files.wordpress.com/2015/04/cleaning.gif" alt="">
                        </div>
                        <div class="card-text">
                            <p>busy</p>
                            <p>занят</p>
                        </div>
                        <div class="card-option">
                            <div class="button-group-column">
                                <button class='danger'>Распылить</button>
                                <button>В колоду</button>
                            </div>
                        </div>
                    </div>
                    <div class="card legend">
                        <div class="card-gif">
                            <img src="https://i.giphy.com/media/e7QhlWUjllr7m3VRSi/giphy.webp" alt="">
                        </div>
                        <div class="card-text">
                            <p>clear</p>
                            <p>чисто</p>
                        </div>
                        <div class="card-option">
                            <div class="button-group-column">
                                <button class='danger'>Распылить</button>
                                <button>В колоду</button>
                            </div>
                        </div>
                    </div>
                    <div class="card common">
                        <div class="card-gif">
                            <img src="https://i.giphy.com/media/XOrFcrJVjhUkwLr4PH/giphy.webp" alt="">
                        </div>
                        <div class="card-text">
                            <p>Will you buy me a new car for Christmas?</p>
                            <p>Ты купишь мне новую машину на Рождество?</p>
                        </div>
                        <div class="card-option">
                            <div class="button-group-column">
                                <button class='danger'>Распылить</button>
                                <button>В колоду</button>
                            </div>
                        </div>
                    </div>
                    <div class="card common">
                        <div class="card-gif">
                            <img src="https://i.giphy.com/media/3o7bug8jhF3LvXDxvy/giphy.webp" alt="">
                        </div>
                        <div class="card-text">
                            <p>To have a good time</p>
                            <p>Хорошо проводить время, чаще используется, как пожелание</p>
                        </div>
                        <div class="card-option">
                            <div class="button-group-column">
                                <button class='danger'>Распылить</button>
                                <button>В колоду</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="deck-paginate">
                <a href="#" class="deck-paginte-item active-paginate-item">1</a>
                <a href="#" class="deck-paginte-item">2</a>
                <a href="#" class="deck-paginte-item">3</a>
            </div>
        </div>
        <div id="tab-content-2" class="tab-content">
            <div>
                <div>
                    <h1>Колоды 1/15</h1>
                </div>
                <div id="deck-card" class='deck'>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                    <div class="deck-card">
                        <h1>Животные</h1>
                        <div class="deck-card-option">
                            <div class="button-group-row">
                                <button class='danger'>Удалить</button>
                                <button>Изменить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
