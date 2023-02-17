import { SendRequest } from "../SendRequest";
import { slideShow } from "../slider";
import { createWord } from '../word/createWord';
import { checkBalance } from "../balance/checkBalance";
import { makeSlider } from "./Slider";
import { getTranslation } from "../getTranslation";
import { appendGif } from "./appendGif";
import { saveNewCard } from "./saveNewCard";
import { fillCard } from "./fillCard";

let card = [];
let stepOneBlock = document.querySelector('#stepOneDisplay');
let stepTooBlock = document.querySelector('#stepTooDisplay');
let stepThreeBlock = document.querySelector('#stepThreeDisplay');
let word = document.querySelector('#word');
let btnStepOne = document.querySelector('#btn-step-one');
let i = 5;



btnStepOne.onclick = () => {

    if (!checkBalance()) {
        alert('Не хватае пыли');
        location = "#close";
        return false;
    }
    stepOne();
}

document.querySelector('#btn-step-too').onclick = () => { stepToo(); }


document.querySelector('#btn-step-one-prev').onclick = () => { prevStepOne(); }
document.querySelector('#btn-step-too-prev').onclick = () => { prevStepToo(); }
document.querySelector('#btn-save-new-card').onclick = () => { saveNewCard(card);prevStepOne()}


async function stepOne() {
    if (!word.value) {
        return false;
    }
    createWord(word.value);
    card['word'] = word.value;
    word.setAttribute('disabled', true);
    makeSlider();
    awaitTranslateIndicator();
    card['data'] = await getTranslation(word.value);
    await getGif(word.value);
    word.removeAttribute('disabled');
    slideShow('.slider', {
        isAutoplay: false
    });
    stepOneBlock.style.display = 'none';
    stepTooBlock.style.display = 'block';
}

function awaitTranslateIndicator() {
    if (!word.hasAttribute('disabled')) {
        btnStepOne.innerText = "Далее";
        btnStepOne.setAttribute('style', 'background:var(--secondary-dark)');
        return;
    }
    if (i == 95) {
        i = 5;
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
function prevStepOne() {
    word.value = '';
    stepOneBlock.style.display = 'block';
    stepTooBlock.style.display = 'none';
    stepThreeBlock.style.display = 'none';
}
function stepToo() {
    try {
        let indexSelectedGif = document.querySelector('ol>li.active').innerHTML;
        card['src'] = card['gifs'][indexSelectedGif].src;
        stepTooBlock.style.display = 'none';
        stepThreeBlock.style.display = 'block';
        fillCard(card);
    } catch (e) {
        prevStepOne();
        console.log(e);
    }
}
function prevStepToo() {
    stepTooBlock.style.display = 'none';
    stepTooBlock.style.display = 'block';
    stepThreeBlock.style.display = 'none';
}




