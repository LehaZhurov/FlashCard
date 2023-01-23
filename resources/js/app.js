import './bootstrap';

import Alpine from 'alpinejs';
import { getBalance } from './balance/getBalance';


window.Alpine = Alpine;

Alpine.start();

getBalance();

