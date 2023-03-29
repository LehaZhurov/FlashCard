import { updateCollectionPage } from "./updateCardCollection";
import { startLoad, stopLoad } from "../load";
import { getBalance } from "../balance/getBalance";
import { SendRequest } from "../SendRequest";

export async function saveNewCard(card) {
    startLoad('body', 'Сохраняем карту');
    let word = card['word'];
    let gif = card['src'];
    let form = new FormData;
    form.append('word', word);
    form.append('gif', gif);
    await SendRequest("POST", '/card/create', form)
        .then(response => {
            stopLoad();
            location = "#close";
            updateCollectionPage();
            getBalance();
        }).catch(err => {
            location = "#close";
            alert(err.message, 'error');
            stopLoad();
        })
}