import { shuffle } from "lodash";
import { getCardsDeck } from "../card/getCardsDeck";
import { startLoad, stopLoad } from "../load";
import { alert } from "../alert";
import { randomEmoji } from "../randomEmogi";
import { upRepeat } from "../card/upRepeat";
export function fromRusToEngGame(deckId) {
    let game = new RusToEngGame();
    game.init(deckId);
}


class RusToEngGame {

    gameName = 'С Английского на Русский';
    gameField = document.querySelector('#game');
    progressBar = '';
    totalCard = 0;
    currentCard = 0;
    cards = [];
    successResponses = 0;
    failResponses = 0;

    init = async (deckId) => {
        this.deckId = deckId;
        await this.getCardsDeck();
        this.setGameName();
        this.viewGameField(true);
        this.showCard();
        this.resetProgress();
    }

    showCard = () => {
        this.showCardName();
        this.showCardImg();
        this.offScrollBody();
        let variables = this.makeVariables();
        this.showVariableButton(variables);
        this.setAudio();
    }

    offScrollBody = () => {
        let body = document.querySelector('body');
        body.style.overflow = 'hidden';
    }

    onScrollBody = () => {
        let body = document.querySelector('body');
        body.removeAttribute('style');
    }

    upCurrentCard() {
        this.currentCard = this.currentCard + 1;
    }

    getCardsDeck = async () => {
        startLoad('body', 'Мешаем карты');
        let cards = await getCardsDeck(this.deckId);
        this.cards = shuffle(cards.data);
        this.totalCard = this.cards.length;
        stopLoad();
    }

    viewGameField(param) {
        if (param) {
            this.gameField.setAttribute('style', 'display:block;');
            return;
        }
        this.gameField.setAttribute('style', 'display:none;')
    }

    setGameName = () => {
        document.querySelector('#namegame').innerHTML = this.gameName;
    }

    resetProgress = () => {
        this.progressBar = this.progressBar + randomEmoji();
        document.querySelector('#gameprogress').innerHTML = this.progressBar + '-' + (this.currentCard + 1) + '/' + this.totalCard;
    }

    showCardName = () => {
        let word = this.cards[this.currentCard].word;
        let gameCardWord = document.querySelector('#gameCardWord');
        gameCardWord.innerText = word;
    }

    setAudio = () => {
        let i = document.createElement('i');
        i.setAttribute('class', 'bx bx-volume-full');
        let source = this.cards[this.currentCard].audio;
        i.onclick = () => {
            var audio = new Audio(); // Создаём новый элемент Audio
            audio.src = source; // Указываем путь к звуку "клика"
            audio.autoplay = true; // Автоматически запускаем
        }
        document.querySelector('#gameCardWord').appendChild(i);
    }

    showCardImg = () => {
        let src = this.cards[this.currentCard].src;
        let gameCardImg = document.querySelector('#gameImg');
        gameCardImg.src = src;
    }

    showVariableButton(variables) {
        let variablesBlock = document.querySelector('#variables');
        variablesBlock.innerHTML = ' ';
        let btn1 = document.createElement('button');
        btn1.innerHTML = variables[0];
        btn1.onclick = () => { this.failResponse() }
        let btn2 = document.createElement('button');
        btn2.innerHTML = variables[1];
        btn2.onclick = () => { this.failResponse() }
        let btn3 = document.createElement('button');
        btn3.innerHTML = variables[2];
        btn3.onclick = () => { this.failResponse() }
        let btn4 = document.createElement('button');
        btn4.innerHTML = variables[3];
        btn4.onclick = () => { this.successResponse() }
        let variablesBtn = [btn1, btn2, btn3, btn4];
        variablesBtn = shuffle(variablesBtn);
        for (let i = 0; i < variablesBtn.length; i++) {
            variablesBlock.append(variablesBtn[i]);
        }
    }

    successResponse = () => {
        if (this.thisEnd() == true) { return }
        this.upCurrentCard();
        this.showCard();
        this.resetProgress();
        upRepeat(this.cards[this.currentCard].id);

    }

    failResponse = () => {
        if (this.thisEnd() == true) { return }
        this.upCurrentCard();
        this.showCard();
        this.resetProgress();
    }

    thisEnd = () => {
        if ((this.currentCard + 1) == this.cards.length) {
            alert('конец игры', 'success');
            this.viewGameField(false);
            this.onScrollBody();
            return true;
        }
        return false;
    }

    makeVariables = () => {
        let tran = this.cards[this.currentCard].info.translate;
        let correctVariable = tran[this.getRandomInt(0, (tran.length - 1))];
        let falseVariables = this.makeFalseVariables();
        falseVariables.push(correctVariable);
        return falseVariables;
    }

    makeFalseVariables = () => {
        let arr = [];
        for (let i = 0; i < 3; i++) {
            let index = this.getRandomInt(0, (this.totalCard - 1));
            if (index == this.currentCard) {
                index = index + 1;
            }
            let randWord = this.cards[index];
            let tran = randWord.info.translate;
            let randTran = tran[this.getRandomInt(0, (tran.length - 1))];
            arr.push(randTran);
        }
        return arr;
    }


    getRandomInt = (min, max) => {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min; //Максимум не включается, минимум включается
    }

}