import { SendRequest } from "../SendRequest";
import { getDecks } from "./getDecks";


let createDeckBtn = document.querySelector('#create_deck_btn');
createDeckBtn.onclick = () =>{
    let data = document.querySelector('#create_deck_form')
    data = new FormData(data);
    saveNewDeck(data);
}

function saveNewDeck(data){
    SendRequest("POST", '/deck/create',data)
        .then(responce => {
            getDecks(1);
        }).catch(err => {
            console.log(err);
        })
}