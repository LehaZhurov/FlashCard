



export function getCardHeader(data){
    let cardGif = document.createElement('div')
    cardGif.setAttribute('class', 'card-gif');
    let img = document.createElement('img');
    img.src = data.src;
    cardGif.appendChild(img);
    return cardGif;
}