

export function echoCardsCounts(pagination){
    let countCardsCurrentPageBlock = document.querySelector('#count_card_current_page');
    let countCardsBlock = document.querySelector('#count_cards');
    let countCardsCurrentPage = 0;
    if(pagination.next_page == null){
        countCardsCurrentPage = pagination.total;
    }else{
        countCardsCurrentPage = pagination.current_page * pagination.count_item_current_page;
    }
    countCardsCurrentPageBlock.innerText = countCardsCurrentPage;
    countCardsBlock.innerText = pagination.total;
}