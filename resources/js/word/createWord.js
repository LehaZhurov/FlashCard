
import { SendRequest } from "../SendRequest";

export function createWord(word){
    let form = new FormData;
    form.append('word', word);
    SendRequest("POST", 'api/word/create',form)
    .then(responce => {

    }).catch(err => {
            console.log(err);
    })
}