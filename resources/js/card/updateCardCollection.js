import { getCards } from "./getCardCollection";

export function updateCollectionPage() {
    if (window.currentPage < 2) {
        getCards(1);
    }
}