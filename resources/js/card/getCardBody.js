

export function getCardBody(data){
    let cardText = document.createElement('div');
    cardText.setAttribute('class', 'card-text');
    let foreign = document.createElement('p');
    foreign.innerText = data.word;
    let native = document.createElement('p');
    let dataTranslateLength = data['info']['translate'].length - 2;
    for (let i = 0; i <= dataTranslateLength; i++) {
        let punctuatioMark = " , ";
        if (i == dataTranslateLength) {
            punctuatioMark = ';';
        }
        native.innerText += " " + data['info']['translate'][i] + punctuatioMark;
    }
    cardText.appendChild(foreign);
    cardText.appendChild(native);
    return cardText;
}