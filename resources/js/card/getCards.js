import { SendRequest } from "../SendRequest";
import {startLoad,stopLoad} from "../load";
function getCards(){
    startLoad('body','Загружаем вашу коллекцию');
    SendRequest("GET", '/card/getCards/')
    .then(responce => {
        console.log(responce);
        stopLoad();
    }).catch(err => {
        console.log(err);
    })
}
getCards();