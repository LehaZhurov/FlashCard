import { SendRequest } from "../SendRequest";
import { startLoad, stopLoad } from "../load";
import { getCardHeader } from "./getCardHeader";
import { getCardBody } from "./getCardBody";
import { getCardOption } from "./getCardOption";
import { getFooterCardFromCollection } from "./getFooterCardFromCollection";
import { cardPagination } from "./cardPagination";
import { echoCardsCounts } from "./echoCardsCountsFromCollection";
import { alert } from "../alert";

let cardDeck = document.querySelector('#deck-card');
/*
    Уровень зависит от количества повторений.Также в зависимости от уровня 
    зависит и цвет.Классы которые задают цевт указаны ниже.
*/
let levels = ['', 'common', 'rare', 'epic', 'legend'];


export function getCards(page) {
    startLoad('body', 'Загружаем вашу коллекцию');
    SendRequest("GET", '/card/getCards/?page=' + page)
        .then(response => {
            clearPageCollection();
            appendCardToPageCollection(response['data']);
            cardPagination(response['pagination']);
            echoCardsCounts(response['pagination']);
            stopLoad();
        }).catch(err => {
            alert(err.message, 'error');
            stopLoad();
        })
}

function appendCardToPageCollection(data) {
    for (let i = 0; i < data.length; i++) {
        cardDeck.appendChild(getCardFromPageCollection(data[i]));
    }
}

function getCardFromPageCollection(data) {
    let card = document.createElement('div');
    card.setAttribute('class', 'card ' + levels[data.level]);
    let cardHeader = getCardHeader(data);
    let cardBody = getCardBody(data);
    let cardFooter = getFooterCardFromCollection(data);
    let cardOption = getCardOption(data, cardFooter, cardBody);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    card.appendChild(cardOption);
    return card;
}

function clearPageCollection() {
    while (cardDeck.children.length > 1) {
        cardDeck.removeChild(cardDeck.lastChild);
    }
}

