import { SendRequest } from "./SendRequest";

export async function getTranslation(word) {
    return await SendRequest("GET", 'api/translation/' + word)
        .then(responce => {
            return responce;
        }).catch(err => {
            console.log(err);
        })
}
