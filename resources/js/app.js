import './bootstrap';

import Alpine from 'alpinejs';
import { getBalance } from './balance/getBalance';
import { getCards } from './card/getCardCollection';
import { getDecks } from './deck/getDecks';
window.Alpine = Alpine;

Alpine.start();

getBalance();
getDecks(1);
getCards(1);
