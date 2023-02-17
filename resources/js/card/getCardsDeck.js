import { SendRequest } from '../SendRequest';


export async function getCardsDeck(id) {
    let responce = await SendRequest("GET", '/deck/' + id + '/cards')
        .then(responce => {
            return responce;
        }).catch(err => {
            console.log(err);
        })
    return responce;
}
