
export function getCardHeader(data) {
    let cardGif = document.createElement('div')
    cardGif.setAttribute('class', 'card-gif');
    let img = document.createElement('img');
    img.src = data.src;
    img.onclick = () => {
        var audio = new Audio(); // Создаём новый элемент Audio
        audio.src = data.audio; // Указываем путь к звуку "клика"
        audio.autoplay = true; // Автоматически запускаем
    }
    cardGif.appendChild(img);
    return cardGif;
}