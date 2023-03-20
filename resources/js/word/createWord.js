
import { SendRequest } from "../SendRequest";
import { createWordAudio } from "./createWordVoiceover";

export function createWord(word) {
    let form = new FormData;
    form.append('word', word);
    SendRequest("POST", 'api/word/create', form)
        .then(response => {
            if (NotAvailabilityAudo(response)) {
                createWordAudio(form);
            }
        }).catch(err => {
            console.log(err);
        })
}

function NotAvailabilityAudo(response) {
    if (response.data.audio == 'def') {
        return true;
    }
    return false;
}