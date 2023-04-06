import { SendRequest } from "../SendRequest";

export function upRepeat(cardId) {
    return SendRequest("GET", '/card/repeat/' + cardId)
        .then(response => {
            return response;
        }).catch(err => {
            alert(err, 'error');
        })
}