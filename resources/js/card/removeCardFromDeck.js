
import { SendRequest } from "../SendRequest"
import { startLoad, stopLoad } from "../load";
import { getCardsDeck } from "./getCardsDeck";
import { alert } from "../alert";

export function removeCardFromDeck(id, deckId) {
    let confimRemoveCardButton = document.querySelector('#comfim_remove_card');
    let aboardRemoveCardButton = document.querySelector('#aboard_remove_card');
    location = "#removeCardFromDeck";
    confimRemoveCardButton.onclick = () => {
        removeCardRequest(id, deckId);
        return true;
    }
    aboardRemoveCardButton.onclick = () => {
        location = "#close";
    }
}

function removeCardRequest(id, deckId) {
    let form = new FormData();
    form.append('card_id', id);
    form.append('deck_id', deckId);
    startLoad('body', 'Убираем карту из колоды');
    SendRequest("POST", '/card/removeCardFromDeck', form)
        .then(response => {
            location = "#close";
            getCardsDeck(deckId);
            stopLoad();
        }).catch(err => {
            alert(err.message, 'error');
            stopLoad();
        })
}