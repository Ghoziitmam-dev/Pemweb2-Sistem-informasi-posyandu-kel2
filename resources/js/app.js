import Alpine from 'alpinejs';
import { api, auth } from './api';

window.Alpine = Alpine;
window.api = api;
window.auth = auth;

Alpine.start();