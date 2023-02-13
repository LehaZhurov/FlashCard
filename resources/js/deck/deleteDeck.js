


import { SendRequest } from "../SendRequest"
import { startLoad, stopLoad } from "../load";
import { getDecks } from "./getDecks";


export function deleteDeck(id){
    let confimDeckButton = document.querySelector('#comfim_delete_deck');
    let aboardDeleteDeckButton = document.querySelector('#aboard_delete_deck');
    location = "#deleteDeck";
    confimDeckButton.onclick = () => {
        deleteDeckRequest(id);
        return true;
    }
    aboardDeleteDeckButton.onclick = () => {
        location = "#close";
    }
}

function deleteDeckRequest(id) {
    startLoad('body', 'Удаляю...');
    SendRequest("GET", '/deck/delete/' + id)
        .then(responce => {
            location = "#close";
            stopLoad();
            getDecks(1);
        }).catch(err => {
            console.log(err);
        })
}