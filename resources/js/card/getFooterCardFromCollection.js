import { deleteCard } from "./deleteCard";
import { addToDeck } from "./addToDeck";
export function getFooterCardFromCollection(data){
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
    let addToDeckBtn = document.createElement('button');
    addToDeckBtn.setAttribute('class', '');
    addToDeckBtn.innerText = 'В колоду';
    addToDeckBtn.onclick = () => {
        addToDeck(data.id);
    }
    buttons.appendChild(sprayBtn);
    buttons.appendChild(addToDeckBtn);
    cardOption.appendChild(buttons);
    return cardOption;
}