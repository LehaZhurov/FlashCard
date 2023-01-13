

//Отоброжает экран загрузки

let loadAnimattionUrl = 'https://i.giphy.com/media/j5sp3actiz8foT88Dp/giphy.webp';
let block;
export function startLoad(blockId, text = 'Загрузка') {
    block = document.querySelector('#' + blockId);
    block.classList.add('nonescroll');
    // up();
    let loadblock = createLoadBLock();
    let loadAnimationBlock = document.createElement('div');
    let img = createLoadAnimation();
    let loadText = createLoadText(text);
    loadAnimationBlock.appendChild(img);
    loadblock.appendChild(loadAnimationBlock);
    loadblock.appendChild(loadText);
    block.appendChild(loadblock);
}

export function stopLoad() {
    let loadblock = document.querySelector('#loadblock');
    if (loadblock) {
        block.removeChild(loadblock);
        block.classList.remove('nonescroll')

    }
}

function createLoadAnimation() {
    let img = document.createElement('img');
    img.src = loadAnimattionUrl;
    return img;
}

function createLoadText(text) {
    let p = document.createElement('p');
    p.innerText = text;
    return p;
}

function createLoadBLock() {
    let loadblock = document.createElement('div');
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
    return loadblock;
}

var t;
function up() {
    var top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
    if (top > 0) {
        window.scrollBy(0, -100);
        t = setTimeout(up(), 20);
    } else clearTimeout(t);
    return false;
}
