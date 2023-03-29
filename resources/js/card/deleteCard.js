
import { SendRequest } from "../SendRequest"
import { updateCollectionPage } from "./updateCardCollection";
import { getBalance } from "../balance/getBalance";
import { startLoad, stopLoad } from "../load";
import { alert } from "../alert";

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
    startLoad('body', 'Распыляю...');
    SendRequest("GET", '/card/delete/' + id)
        .then(response => {
            location = "#close";
            stopLoad();
            updateCollectionPage();
            getBalance();
        }).catch(err => {
            alert(err, 'error');
            stopLoad();
        })
}