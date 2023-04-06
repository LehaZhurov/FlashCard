import { fromRusToEngGame } from "./fromRusToEngGame";

export function chooseGameMode(deckId) {
    let fromRusToEngGMBtn = document.querySelector('#from_rus_to_eng');
    // let aboardDeleteDeckButton = document.querySelector('#aboard_delete_deck');
    location = "#chooseGameMode";
    fromRusToEngGMBtn.onclick = () => {
        location = '#close';
        fromRusToEngGame(deckId);
        return;
    }
}