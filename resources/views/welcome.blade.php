    @extends('layouts/app')
    @section('title')
        Добро пожаловать
    @endsection
    @section('content')
        <div id="content">
            <div id="index_header" style='background-image: url(storage/img/world.png);'>
                <div>
                    <h1>Миллионы слов и фраз уже ждут тебя!</h1>
                    <button>Начать</button>
                </div>
            </div>
            <div id="index_body">
                <div id="about_me">
                    <div class="block_picture_text">
                        <img class="picture_text_img" src="storage/img/graphic.gif" alt="">
                        <div class='picture_text'>
                            <h1>Высокая эффективность</h1>
                            <p>Наше приложение поможет вам быстро и легко пополнять словарный запас</p>
                        </div>
                    </div>
                    <div class="block_picture_text">
                        <div class='picture_text'>
                            <h1>Нескучно!</h1>
                            <p>Учение слов не должно быть скучным!Учить то что нравится дает стимул заниматься
                                каждый день.</p>
                        </div>
                        <img class="picture_text_img" src="/storage/img/poop.gif" alt="">
                    </div>
                    <div class="block_picture_text">
                        <img class="picture_text_img" src="/storage/img/face.gif" alt="">
                        <div class='picture_text'>
                            <h1>Индивидуальноcть</h1>
                            <p>Никто лучше вас не знает чего вы хотите,поэтому у вас полная свобода какие слова или
                                фразы учить.</p>
                        </div>
                    </div>
                    <div class="block_picture_text">
                        <div class='picture_text'>
                            <h1>Низкая стоимсть</h1>
                            <p>Всего за 99р вы получаете все приемущества нашего сервиса.Ни каких разделений - все равны.
                            </p>
                        </div>
                        <img class="picture_text_img" src="storage/img/coins.gif" alt="">
                    </div>
                </div>
            </div>
            <div id="index_footer">
                <div>
                    <h1>Почему мы ?</h1>
                    <p>Мы используем лучшие технологие машиного перевода.Что бы вы могли получить самый лучший перевод!
                    </p>
                </div>
            </div>
        </div>
    @endsection
