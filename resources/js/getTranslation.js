import { SendRequest } from "./SendRequest";

export async function getTranslation(word) {
    return await SendRequest("GET", '/translation/' + word)
        .then(responce => {
            return responce;
        }).catch(err => {
            console.log(err);
        })
}
