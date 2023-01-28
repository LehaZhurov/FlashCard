import { SendRequest } from "../SendRequest";
import { startLoad, stopLoad } from "../load";
import { getCardHeader } from "./getCardHeader";
import { getCardBody } from "./getCardBody";
import { getFooterCardFromCollection } from "./getFooterCardFromCollection";
import { cardPagination } from "./cardPagination";
import { echoCardsCounts } from "./echoCardsCountsFromCollection";

let cardDeck = document.querySelector('#deck-card');
/*
    Уровень зависит от количества повторений.Также в зависимости от уровня 
    зависит и цвет.Классы которые задают цевт указаны ниже.
*/
let levels = ['', 'common', 'rare', 'epic', 'legend'];


export function getCards(page) {
    startLoad('body', 'Загружаем вашу коллекцию');
    SendRequest("GET", '/card/getCards/?page='+page)
        .then(responce => {
            clearPageCollection();
            appendCardToPageCollection(responce['data']);
            cardPagination(responce['pagination']);
            echoCardsCounts(responce['pagination']);
            stopLoad();
        }).catch(err => {
            console.log(err);
        })
}
getCards(1);

function appendCardToPageCollection(data){
    for(let i = 0; i < data.length; i++){
        cardDeck.appendChild(getCardFromPageCollection(data[i]));
    }
}

function getCardFromPageCollection(data) {
    let card = document.createElement('div');
    card.setAttribute('class', 'card ' + levels[data.level]);
    let cardHeader = getCardHeader(data);
    let cardBody = getCardBody(data);
    let cardFooter = getFooterCardFromCollection(data);
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    card.appendChild(cardFooter);
    return card;
}

function clearPageCollection() {
    while (cardDeck.children.length > 1) {
        cardDeck.removeChild(cardDeck.lastChild);
    }
}

