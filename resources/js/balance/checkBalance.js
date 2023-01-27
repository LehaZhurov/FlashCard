

export function checkBalance(){
    let balance = document.querySelector('#balance').innerText;
    if(balance > 1000){
        return true;
    }
    return false;
}