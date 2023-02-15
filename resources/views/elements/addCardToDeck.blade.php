<div id="addCardToDeck" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Выбирете колоду</h3>
                <a href="#close" title="Close" class="close">×</a>
            </div>
            <div class="modal-body">
                <div class='modal-flex-box'>
                    <form action="#" id='add_card_to_deck_form'>
                        <input type="text" name='card_id' style='display:none;' id = 'input_deck_from_add_card'>
                        <select name="deck_id" id="select_deck_from_add_card">
                            <option value="1">
                                Животные
                            </option>
                        </select>
                    </form>
                </div>
                <div class="button-group-row">
                    <button id='comfim_add_to_deck'>Добавить</button>
                    <button id='aboard_add_to_deck' class='danger'>Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
