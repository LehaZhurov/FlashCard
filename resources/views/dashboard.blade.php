@extends('layouts/app')
@section('title')
    Добро пожаловать
@endsection
@section('header')
    </div>
    <div id='menu'>
        <span title='Буквопыль использутся для создания новых карт'><span id="balance">30000</span><i
                class='bx bxs-vial'></i></span>
        {{-- <button>Играть</button> --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();">
                Выйти</a>
        </form>
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
            @include('components/cardcollection')
        </div>
        <div id="tab-content-2" class="tab-content">
            @include('components/carddecks')
        </div>
    </div>
    @include('elements/createcardmodal')
    @include('elements/confimspraycard')
    @include('elements/creatеdeck')
@endsection
@section('scripts')
    @vite(['resources/js/card/createCard.js', 'resources/js/card/getCardCollection.js'])
@endsection
