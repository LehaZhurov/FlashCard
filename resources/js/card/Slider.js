export function makeSlider() {
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

export function sliderItem(src) {
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