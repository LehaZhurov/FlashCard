<div id="createCard" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Новая карта</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <div id='createCardStepOne' class='modal-flex-box'>
                    <h1>Введите слово</h1>
                    <form action="#">
                        <label for="world">Введите слово на английском</label>
                        <input type="text" name='world' id='world' placeholder="Cлово">
                        <button>Найти</button>
                    </form>
                </div>
                <div id='createCardStepToo' class='modal-flex-box'>
                    <h1>Выбирите гифку</h1>
                    <div class="itc-slider slider" data-slider="itc-slider" data-loop="false" data-autoplay="false">
                        <div class="itc-slider__wrapper">
                            <div class="itc-slider__items">
                                <div class="itc-slider__item">
                                    <div class="slider-gif">
                                        <img src="https://i.giphy.com/media/hsxHqVGqz4vxg5N7xb/giphy.webp"
                                            alt="">
                                    </div>
                                </div>
                                <div class="itc-slider__item">
                                    <div class="slider-gif">
                                        <img src="https://i.giphy.com/media/11tTNkNy1SdXGg/giphy.webp" alt="">
                                    </div>
                                </div>
                                <div class="itc-slider__item">
                                    <div class="slider-gif">
                                        <img src="https://i.giphy.com/media/QGzPdYCcBbbZm/giphy.webp" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Кнопки для перехода к предыдущему и следующему слайду -->
                        <button class="itc-slider__btn itc-slider__btn_next"></button>
                        <button class="itc-slider__btn itc-slider__btn_prev"></button>
                    </div>
                </div>
                <div id='createCardStepThree' class='modal-flex-box'>
                    <h1>Сохранить карту?</h1>
                </div>
            </div>
        </div>
    </div>
</div>
