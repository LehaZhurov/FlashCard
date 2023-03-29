export function alert(text, type) {

    let colors = {
        'success': "green",
        'danger': 'yellow',
        'error': 'red',
    };
    let color;
    try {
        color = colors[type]
    } catch (e) {
        throw new Error('Не поддреживаемый тип уведомления');
    }

    let alertBlock = document.createElement('div');
    let textBlock = document.createElement('span');
    textBlock.innerText = text;
    alertBlock.appendChild(textBlock);
    alertBlock.setAttribute('style', style(color));
    let body = document.querySelector('body');
    body.appendChild(alertBlock);
    setTimeout(function () {
        body.removeChild(alertBlock);
    }, 6000)

}

// *{
//     background-color: #fff;
//     position:absolute;
//     right:0;
//     top:0;
//     margin:10px;
//     min-height: 50px;
// }

function style(color) {
    let styles = {
        'position': 'fixed',
        'background-color': color,
        'right': '0',
        'bottom': '0',
        'margin': '10px',
        'min-height': '50px',
        'padding': '10px',
        'color': '#FFFFFF',
        'min-width': '10vw',
        'text-align': 'center',
        'border-radius': '30px',
        'display': 'flex',
        'justify-content': 'center',
        'align-items': 'center',
        'font-size': '20px'
    };
    let styleStr = '';
    for (var key in styles) {
        styleStr = styleStr + key + ":" + styles[key] + ';';
    }
    return styleStr;
}