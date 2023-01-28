import { SendRequest } from "../SendRequest";


let createDeckBtn = document.querySelector('#create_deck_btn');
createDeckBtn.onclick = () =>{
    saveNewDeck();
}

function saveNewDeck(data){
    SendRequest("POST", '/deck/create',data)
        .then(responce => {
            console.log(responce)
        }).catch(err => {
            console.log(err);
        })
}