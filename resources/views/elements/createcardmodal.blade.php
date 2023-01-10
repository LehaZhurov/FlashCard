<div id="createCard" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Новая карта</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <div id="stepOneDisplay" style='display:block;'>
                    <div id='createCardStepOne' class='modal-flex-box'>
                        <h1>Введите слово</h1>
                        <form action="#">
                            <label for="word" >Введите слово на английском</label>
                            <input type="text" name='word' id='word' placeholder="Cлово" >
                            <button id='btn-step-one' type="button">Далее</button>
                        </form>
                    </div>
                </div>
                <div id="stepTooDisplay" style="display:none;">
                    <div id='createCardStepToo' class='modal-flex-box'>
                        <h1>Выбирите гифку</h1>
                        <div id="slider-block">
                            <div class="slider">
                                <div class="slider__wrapper">
                                    <div class="slider__items" id='select-gif'>
                                        
                                    </div>
                                    <a class="slider__control slider__control_prev" href="#" role="button"><</a>
                                    <a class="slider__control slider__control_next" href="#" role="button">></a>
                                </div>
                            </div>
                        </div>
                        <div class ='button-group-row'>
                            <button id = 'btn-step-one-prev'>Назад</button>
                            <button id = 'btn-step-too'>Далее</button>
                        </div>
                    </div>
                </div>
                <div id="stepThreeDisplay" style='display:none;'>
                    <div id='createCardStepThree' class='modal-flex-box'>
                        <h1>Сохранить карту?</h1>
                        <div class="card common" style = 'width:100%;'>
                            <div class="card-gif">
                                <img src="https://i.giphy.com/media/XOrFcrJVjhUkwLr4PH/giphy.webp" alt="" id = 'creatingCardImg'>
                            </div>
                            <div class="card-text">
                                <p id = 'creatingCardWord'>Will you buy me a new car for Christmas?</p>
                                <p id = 'creatingCardTranslate'>Ты купишь мне новую машину на Рождество?</p>
                            </div>
                            <div class="card-option">
                                <div class="button-group-column">
                                    <button>Сохранить</button>
                                    <button id = 'btn-step-too-prev'>Назад</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
