import { startLoad, stopLoad } from '../load';
import { getCardHeader } from "../card/getCardHeader";
import { getCardBody } from "../card/getCardBody";
import { getFooterCardFromDeck } from '../card/getFooterCardFromDeck';
import { getCardsDeck } from '../card/getCardsDeck';
import { echoCountCardsFormDeck } from './echoCountCardsFromDeck';
import { getCardOption } from '../card/getCardOption';
let deckBlock = document.querySelector('#decks-view');
let cardsFromDeck = document.querySelector('#cards-deck-view');
let backToDeckButton = document.querySelector('#back-to-decks');
let cardsDeck = document.querySelector('#cards-deck');
/*
    Уровень зависит от количества повторений.Также в зависимости от уровня 
    зависит и цвет.Классы которые задают цевт указаны ниже.
*/
let levels = ['', 'common', 'rare', 'epic', 'legend'];

export async function editDeck(id) {
    viewCardsDeck();
    startLoad('body', 'Просматриваю колоду');
    let response = await getCardsDeck(id);
    clearPageDeckCollection();
    appendCardToDeckPageCollection(response['data']);
    echoCountCardsFormDeck(response['data']);
    stopLoad();
}

function viewCardsDeck() {
    deckBlock.setAttribute('style', 'display:none');
    cardsFromDeck.setAttribute('style', 'display:block');
}

backToDeckButton.onclick = () => {
    hidenCardsDeck();
}
function hidenCardsDeck() {
    deckBlock.setAttribute('style', 'display:block');
    cardsFromDeck.setAttribute('style', 'display:none');
}



function appendCardToDeckPageCollection(data) {
    for (let i = 0; i < data.length; i++) {
        cardsDeck.appendChild(getCardFromDeckPage(data[i]));
    }
}

function getCardFromDeckPage(data) {
    let card = document.createElement('div');
    card.setAttribute('class', 'card ' + levels[data.level]);
    let cardHeader = getCardHeader(data);
    let cardBody = getCardBody(data);
    let cardFooter = getFooterCardFromDeck(data);
    let cardOption = getCardOption(data, cardFooter, cardBody);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    card.appendChild(cardOption);
    return card;
}

function clearPageDeckCollection() {
    cardsDeck.innerHTML = " ";
}