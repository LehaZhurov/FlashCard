import {SendRequest} from '../SendRequest';


export function getBalance(){
    SendRequest("GET", '/profile/balance')
    .then(responce => {
        updateBalance(responce.data)
    }).catch(err => {
        console.log(err);
    })
}

function updateBalance(data){
    let balanceBlock = document.querySelector('#balance');
    balanceBlock.innerText = data.balance;
}