
export function fillCard(card) {
    let creatingCardWord = document.querySelector('#creatingCardWord');
    creatingCardWord.innerHTML = ' ';
    creatingCardWord.innerHTML = card['word'];
    let creatingCardTranslate = document.querySelector('#creatingCardTranslate');
    creatingCardTranslate.innerHTML = ' '
    let dataTranslateLength = card['data']['translate'].length;
    for (let i = 0; i < dataTranslateLength; i++) {
        let punctuatioMark = " , ";
        if (i == dataTranslateLength - 1) {
            punctuatioMark = ';';
        }
        creatingCardTranslate.innerHTML += " " + card['data']['translate'][i] + punctuatioMark;
    }
    let creatingCardImg = document.querySelector('#creatingCardImg');
    creatingCardImg.src = card['src'];
}