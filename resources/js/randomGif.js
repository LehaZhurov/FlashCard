import {SendRequest} from './SendRequest';

export async function RandomGif(tag) {
    let result;
    await SendRequest("GET", '/gif/random/' + tag)
        .then(response => {
            result = response;
        }).catch(err => {
            console.log(err);
        })
    return result;
}