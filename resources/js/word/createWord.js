
import { SendRequest } from "../SendRequest";

export function createWord(word){
    SendRequest("GET", '/word/create/' + word)
    .then(responce => {

    }).catch(err => {
            console.log(err);
    })
}