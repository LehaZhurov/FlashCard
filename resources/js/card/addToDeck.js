import { SendRequest } from "../SendRequest"


export function addToDeck(id){
    location = "#addCardToDeck";
    let confimAddCardToDeckButton = document.querySelector('#comfim_add_to_deck');
    let aboardAddCardToDeckButton = document.querySelector('#aboard_add_to_deck');
    confimAddCardToDeckButton.onclick = () => {
        addCardToDeckRequest(id);
        return true;
    }
    aboardAddCardToDeckButton.onclick = () => {
        location = "#close";
    }
    let input = document.querySelector('#input_deck_from_add_card');
    input.value = id;
}

function addCardToDeckRequest(){
    let form = document.querySelector('#add_card_to_deck_form');
    let body = new FormData(form);
    SendRequest("POST", '/card/addToDeck',body)
        .then(responce => {
            location = "#close";
        }).catch(err => {
            console.log(err);
        })
}