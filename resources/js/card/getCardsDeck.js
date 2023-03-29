import { SendRequest } from '../SendRequest';
import { alert } from '../alert';

export async function getCardsDeck(id) {
    let response = await SendRequest("GET", '/deck/' + id + '/cards')
        .then(response => {
            return response;
        }).catch(err => {
            alert(err.message, 'error');
        })
    return response;
}
