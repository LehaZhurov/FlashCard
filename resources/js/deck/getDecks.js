import { startLoad, stopLoad } from "../load";
import { SendRequest } from "../SendRequest";
import { deleteDeck } from "./deleteDeck";
import { echoCountDeck } from "./echoCountDecks";
import { editDeck } from "./editDeck";
import { fillDeckSelectFromId } from './fillDeckSelect';
import { alert } from "../alert";
import { chooseGameMode } from "../game/chooseGameMode";

let decks = document.querySelector('#deck-card-deck');

export function getDecks(page = 1) {
    startLoad('body', 'Загружаем вашы колоды');
    SendRequest("GET", '/deck/getDecks/?page=' + page)
        .then(response => {
            clearDeckPage();
            appendDeckToPage(response['data']);
            fillDeckSelectFromId('select_deck_from_add_card', response['data']);
            echoCountDeck(response['data']);
            stopLoad();
        }).catch(err => {
            alert(err.message, 'error');
            stopLoad();
        })
}

function clearDeckPage() {
    while (decks.children.length > 1) {
        decks.removeChild(decks.lastChild);
    }
}

function appendDeckToPage(data) {
    for (var i = 0; i < data.length; i++) {
        decks.appendChild(getDeckLayout(data[i]));
    }
}

function getDeckLayout(data) {
    let deckCard = document.createElement('div');
    deckCard.setAttribute('class', 'deck-card');
    let h1 = document.createElement('h1');
    h1.innerText = data.name;
    deckCard.appendChild(h1);
    let deckCardOption = document.createElement('div');
    deckCardOption.setAttribute('class', 'deck-card-option');
    let buttonGroup = document.createElement('div');
    buttonGroup.setAttribute('class', 'button-group-row');
    deckCardOption.appendChild(buttonGroup);

    let deleteButton = document.createElement('button');
    deleteButton.setAttribute('class', 'danger');
    let deleteButtonIcon = document.createElement('i')
    deleteButtonIcon.setAttribute('class', 'bx bxs-trash')
    deleteButton.appendChild(deleteButtonIcon);
    deleteButton.onclick = () => {
        deleteDeck(data.id);
    }

    let editButton = document.createElement('button');
    let editButtonIcon = document.createElement('i')
    editButtonIcon.setAttribute('class', 'bx bxs-edit')
    editButton.appendChild(editButtonIcon);
    editButton.onclick = () => {
        editDeck(data.id);
    }

    let playButton = document.createElement('button');
    let playButtonIcon = document.createElement('i')
    playButtonIcon.setAttribute('class', 'bx bx-play')
    playButton.appendChild(playButtonIcon);
    playButton.onclick = () => {
        chooseGameMode(data.id);
    }

    buttonGroup.appendChild(editButton);
    buttonGroup.appendChild(deleteButton);
    buttonGroup.appendChild(playButton);

    deckCard.appendChild(deckCardOption);
    return deckCard;
}