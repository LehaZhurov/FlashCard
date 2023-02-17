import { sliderItem } from "./Slider";

export function appendGif(data) {
    let countGif = data.length;
    let sliderItems = document.querySelector('#select-gif');
    sliderItems.innerHTML = ' ';
    for (let i = 0; i < countGif; i++) {
        sliderItems.appendChild(sliderItem(data[i].src));
    }
}

