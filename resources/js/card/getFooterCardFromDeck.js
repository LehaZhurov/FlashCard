import { deleteCard } from "./deleteCard";
import { removeCard } from "./removeCardFromDeck";

export function getFooterCardFromDeck(data){
    let cardOption = document.createElement('div');
    cardOption.setAttribute('class', 'card-option');
    let buttons = document.createElement('div');
    buttons.setAttribute('class', 'button-group-column');
    cardOption.appendChild(buttons);
    let sprayBtn = document.createElement('button')
    sprayBtn.setAttribute('class', 'danger');
    sprayBtn.innerText = 'Распылить';
    sprayBtn.onclick = () =>{
        deleteCard(data.id);
    }
    let removeFromDeckBtn = document.createElement('button');
    removeFromDeckBtn.setAttribute('class', 'danger');
    removeFromDeckBtn.innerText = 'Удалить из колоды';
    removeFromDeckBtn.onclick = () => {
        removeCard(data.id);
    }
    buttons.appendChild(sprayBtn);
    buttons.appendChild(removeFromDeckBtn);
    cardOption.appendChild(buttons);
    return cardOption;
}