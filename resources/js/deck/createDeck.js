import { SendRequest } from "../SendRequest";
import { getDecks } from "./getDecks";
import { startLoad,stopLoad } from "../load";
import { alert } from "../alert";

let createDeckBtn = document.querySelector('#create_deck_btn');
createDeckBtn.onclick = () =>{
    let data = document.querySelector('#create_deck_form')
    data = new FormData(data);
    saveNewDeck(data);
}

function saveNewDeck(data){
    startLoad('body','Создаем колоду')
    SendRequest("POST", '/deck/create',data)
        .then(response => {
            stopLoad('body','Готово')
            getDecks(1);
            location.href = '#close';
        }).catch(err => {
            alert(err.message, 'error');
            stopLoad();
        })
}