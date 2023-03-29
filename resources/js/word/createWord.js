import { SendRequest } from "../SendRequest";
import { createWordAudio } from "./createWordVoiceover";
import { alert } from "../alert";

export function createWord(word) {
    let form = new FormData;
    form.append('word', word);
    SendRequest("POST", 'api/word/create', form)
        .then(response => {
            if (NotAvailabilityAudo(response)) {
                createWordAudio(form);
            }
        }).catch(err => {
            alert(err.message, 'error');
        })
}

function NotAvailabilityAudo(response) {
    if (response.data.audio == 'def' || response.data.audio == "") {
        return true;
    }
    return false;
}