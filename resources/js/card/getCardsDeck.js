import { SendRequest } from '../SendRequest';

export async function getCardsDeck(id) {
    let response = await SendRequest("GET", '/deck/' + id + '/cards')
        .then(response => {
            return response;
        }).catch(err => {
            console.log(err);
        })
    return response;
}
