
import { SendRequest } from "../SendRequest";

export function createWordAudio(form) {
    return SendRequest("POST", 'api/word/audio/create', form)
        .then(response => {
            return response;
        }).catch(err => {
            console.log(err);
        })
}