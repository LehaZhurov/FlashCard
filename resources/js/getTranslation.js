import { SendRequest } from "./SendRequest";

export async function getTranslation(word) {
    return await SendRequest("GET", 'api/translation/' + word)
        .then(response => {
            return response;
        }).catch(err => {
            console.log(err);
        })
}
