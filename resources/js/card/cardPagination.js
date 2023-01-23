import { getCards } from "./getCardCollection"

export function cardPagination(pagination) {
    window.currentPage = pagination.current_page;

    let deckPagination = document.querySelector('#collection-pagination');
    deckPagination.innerHTML = ' ';

    let currentPage = document.createElement('a');
    currentPage.innerText = pagination.current_page;
    currentPage.setAttribute('class', 'deck-paginte-item active-paginate-item');
    currentPage.setAttribute('role', 'button');
    currentPage.onclick = () => {
        getCards(pagination.current_page);
    }

    if (pagination.prev_page != null) {
        let prevPage = document.createElement('a');
        prevPage.setAttribute('class', 'deck-paginte-item');
        prevPage.innerText = pagination.prev_page;
        prevPage.setAttribute('role','button');
        prevPage.setAttribute('href', '#' + pagination.prev_page);
        prevPage.onclick = () => {
            getCards(pagination.prev_page);
            console.log(pagination.prev_page);
        }
        deckPagination.appendChild(prevPage);
    }

    deckPagination.appendChild(currentPage);

    if (pagination.next_page != null) {
        let nextPage = document.createElement('a');
        nextPage.setAttribute('class', 'deck-paginte-item');
        nextPage.setAttribute('role', 'button');
        nextPage.setAttribute('href', '#' + pagination.next_page);
        nextPage.innerText = pagination.next_page;
        nextPage.onclick = () => {
            getCards(pagination.next_page);
            console.log(pagination.next_page);
        }
        deckPagination.appendChild(nextPage);
    }

}

