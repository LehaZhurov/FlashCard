import { RandomGif } from "./randomGif";


//Отоброжает экран загрузки
export function load(blockId, text = 'Загрузка', start) {
    let block = document.querySelector('#' + blockId)
    //Выводить экран загрузки если функция вызвана с true
    if (start == true) {
        up();
        let loadblock = document.createElement('div');
        block.classList.add('nonescroll')
        loadblock.setAttribute('style', `
            position: absolute;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            background-color: var(--secondary-light);
            flex-direction:column;
            height: `+ window.innerHeight + `px;
            z-index:100000;
            align-items: center;
        `);
        loadblock.setAttribute('id', 'loadblock');
        let spiner = document.createElement('div');
        let img = document.createElement('img');
        img.src = "https://i.giphy.com/media/j5sp3actiz8foT88Dp/giphy.webp";
        spiner.appendChild(img);
        loadblock.appendChild(spiner);
        let p = document.createElement('p');
        p.innerText = text;
        loadblock.appendChild(p);
        block.appendChild(loadblock);
        //Скрыть созданный экран переда false
    } else {
        let loadblock = document.querySelector('#loadblock');
        if (loadblock) {
            block.removeChild(loadblock);
            block.classList.remove('nonescroll')

        }
    }
}

var t;
function up() {
	var top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
	if(top > 0) {
		window.scrollBy(0,-100);
		t = setTimeout(up(),20);
	} else clearTimeout(t);
	return false;
}
