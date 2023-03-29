import { SendRequest } from "../SendRequest";
import { alert } from "../alert";

export function createWordAudio(form) {
    return SendRequest("POST", 'api/word/audio/create', form)
        .then(response => {
            return response;
        }).catch(err => {
            alert(err.message, 'error');
        })
}