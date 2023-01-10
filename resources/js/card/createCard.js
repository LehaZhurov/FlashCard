import { SendRequest } from "../SendRequest";
import { slideShow } from "../slider";

let card = [];
let stepOneBlock = document.querySelector('#stepOneDisplay');
let stepTooBlock = document.querySelector('#stepTooDisplay');
let stepThreeBlock = document.querySelector('#stepThreeDisplay');
let word = document.querySelector('#word');
let btnStepOne = document.querySelector('#btn-step-one');
btnStepOne.onclick = () => { stepOne(); }

let i = 5;
function awaitTranslateIndicator() {
    if (!word.hasAttribute('disabled')) {
        btnStepOne.innerText = "Далее"
        btnStepOne.setAttribute('style', 'background:var(--secondary-dark)');
        return;
    }
    if (i == 95) {
        i = 10
        return awaitTranslateIndicator();
    }
    btnStepOne.innerText = "Ищем гифки и перевод"
    setTimeout(() => {
        btnStepOne.setAttribute('style', `background:linear-gradient(110deg, var(--secondary-dark) 0%, 
        var(--secondary-dark) `+ (i - 5) + `%, rgba(239,239,242,1) ` + i + `%, var(--secondary-dark) ` + (i + 5) + `%, 
        var(--secondary-dark) 100%);`)
        awaitTranslateIndicator();
    }, 10)
    i++;
    return;
}

async function stepOne() {
    if (!word.value) {
        return false;
    }
    word.setAttribute('disabled', true);
    card['word'] = word.value;
    initSlider();
    await getTranslation(word.value);
    await getGif(word.value);
    stepOneBlock.style.display = 'none';
    stepTooBlock.style.display = 'block';
    word.removeAttribute('disabled');
    slideShow('.slider', {
        isAutoplay: false
    });
}

async function getTranslation(word) {
    awaitTranslateIndicator();
    await SendRequest("GET", '/translation/' + word)
        .then(responce => {
            card['data'] = responce;
            console.log(card);
        }).catch(err => {
            console.log(err);
        })
}

async function getGif(word) {
    await SendRequest("GET", '/gif/search/' + word)
        .then(responce => {
            appendGif(responce['data']);
            card['gifs'] = responce['data'];
        }).catch(err => {
            prevStepOne();
            console.log(err);
        })
}

function initSlider() {
    let block = document.querySelector('#slider-block');
    block.innerHTML = ' ';
    let slider = document.createElement('div');
    slider.setAttribute('class', 'slider');
    let sliderWrapper = document.createElement('div');
    sliderWrapper.setAttribute('class', 'slider__wrapper')
    let sliderItems = document.createElement('div');
    sliderItems.setAttribute('class', 'slider__items');
    sliderItems.setAttribute('id', 'select-gif');
    let prev = document.createElement('a');
    prev.setAttribute('class', 'slider__control slider__control_prev')
    prev.setAttribute('href', '#')
    prev.setAttribute('role', 'button')
    prev.innerHTML = '<';
    let next = document.createElement('a');
    next.setAttribute('class', 'slider__control slider__control_next')
    next.setAttribute('href', '#')
    next.setAttribute('role', 'button')
    next.innerHTML = '>';
    slider.appendChild(sliderWrapper);
    sliderWrapper.appendChild(sliderItems);
    sliderWrapper.appendChild(prev);
    sliderWrapper.appendChild(next);
    block.appendChild(slider);
    return true;
}

function appendGif(data) {
    let sliderItems = document.querySelector('#select-gif');
    sliderItems.innerHTML = ' ';
    for (let i = 0; i < data.length; i++) {
        sliderItems.appendChild(sliderItem(data[i].src));
    }

}

function sliderItem(src) {
    let itcSliderItem = document.createElement("div");
    itcSliderItem.setAttribute('class', 'slider__item');
    let sliderGif = document.createElement("div");
    sliderGif.setAttribute('class', 'slider-gif');
    let img = document.createElement("img");
    img.src = src;
    itcSliderItem.appendChild(sliderGif);
    sliderGif.appendChild(img);
    return itcSliderItem;
}

document.querySelector('#btn-step-one-prev').onclick = () => { prevStepOne(); }

function prevStepOne() {
    stepOneBlock.style.display = 'block';
    word.value = '';
    stepTooBlock.style.display = 'none';
}
document.querySelector('#btn-step-too').onclick = () => { stepToo(); }
function stepToo() {
    let indexSelectedGif = document.querySelector('ol>li.active').innerHTML;
    card['src'] = card['gifs'][indexSelectedGif].src;
    fillCard();
    stepTooBlock.style.display = 'none';
    stepThreeBlock.style.display = 'block';
}

function fillCard() {
    let creatingCardWord = document.querySelector('#creatingCardWord');
    creatingCardWord.innerHTML = ' ';
    creatingCardWord.innerHTML = card['word'];
    let creatingCardTranslate = document.querySelector('#creatingCardTranslate');
    creatingCardTranslate.innerHTML = ' '
    for (let i = 0; i < card['data']['translate'].length - 1; i++) {
        creatingCardTranslate.innerHTML += " " + card['data']['translate'][i];
    }
    let creatingCardImg = document.querySelector('#creatingCardImg');
    creatingCardImg.src = card['src'];
}

document.querySelector('#btn-step-too-prev').onclick = () => { prevStepToo(); }
function prevStepToo() {
    stepTooBlock.style.display = 'block';
    stepThreeBlock.style.display = 'none';
}