
import { SendRequest } from "../SendRequest"
import { updateCollectionPage } from "./updateCardCollection";
import { getBalance } from "../balance/getBalance";
import { startLoad, stopLoad } from "../load";
export function deleteCard(id) {
    let confimCardButton = document.querySelector('#comfim_delete_card');
    let aboardDeleteCardButton = document.querySelector('#aboard_delete_card');
    location = "#deleteCard";
    confimCardButton.onclick = () => {
        deleteCardRequest(id);
        return true;
    }
    aboardDeleteCardButton.onclick = () => {
        location = "#close";
    }
}

function deleteCardRequest(id) {
    startLoad('body','Распыляю...');
    SendRequest("GET", '/card/delete/' + id)
        .then(responce => {
            console.log(responce);
            location = "#close";
            stopLoad();
            updateCollectionPage();
            getBalance();
        }).catch(err => {
            console.log(err);
        })
}