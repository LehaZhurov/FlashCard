
export function getCardOption(data, footer, body) {
    let div = document.createElement('div');
    div.setAttribute('class', 'view-option-and-voice');
    let voice = document.createElement('i');
    voice.setAttribute('class', 'bx bx-volume-full')
    voice.onclick = () => {
        var audio = new Audio(); // Создаём новый элемент Audio
        audio.src = data.audio; // Указываем путь к звуку "клика"
        audio.autoplay = true; // Автоматически запускаем
    }
    let option = document.createElement('i');
    option.setAttribute('class', 'bx bxs-cog')
    option.onclick = () => {
        if (footer.style.display == 'none') {
            footer.style.display = 'block';
            body.style.display = 'none';
        } else {
            footer.style.display = 'none';
            body.style.display = 'block';
        }
    }
    div.appendChild(voice);
    div.appendChild(option);
    return div;
}