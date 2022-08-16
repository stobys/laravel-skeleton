
// -- Alpine.JS
import Alpine from 'alpinejs'
import alpineData from './alpine/default.js'

window.Alpine = Alpine

Alpine.data('alpineData', alpineData)

document.addEventListener('DOMContentLoaded', function (event) {
    Alpine.start();
});
