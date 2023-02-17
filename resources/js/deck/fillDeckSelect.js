


export function fillDeckSelectFromId(selector,data){
    let select = document.querySelector('#'+selector);
    select.innerHTML = " ";
    for(let i=0;i<data.length;i++){
        select.appendChild(greateOption(data[i]));
    }
}

function greateOption(data){
    let option = document.createElement('option');
    option.innerText = data.name;
    option.setAttribute('value', data.id);
    return option;
}