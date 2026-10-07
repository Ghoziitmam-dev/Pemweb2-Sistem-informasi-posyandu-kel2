import Alpine from 'alpinejs';
import { api, auth, getMe, clearMeCache, toast } from './api';

window.Alpine = Alpine;
window.api = api;
window.auth = auth;
window.getMe = getMe;
window.clearMeCache = clearMeCache;
window.toast = toast;

Alpine.start();