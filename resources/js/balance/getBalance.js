import { SendRequest } from '../SendRequest';
import { alert } from '../alert';

export function getBalance() {
    SendRequest("GET", '/profile/balance')
        .then(response => {
            updateBalance(response.data)
        }).catch(err => {
            alert(err.message, 'error')
        })
}

function updateBalance(data) {
    let balanceBlock = document.querySelector('#balance');
    balanceBlock.innerText = data.balance;
}