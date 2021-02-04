/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
const jQuery = require('jquery');

window.$ = jQuery;
window.jQuery = jQuery;
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');


$(document).ready(function() {
    $('.cardPlayer').delay(1800).queue(function(next) {
        $(this).removeClass('hover');
        $('.aPlayer.hover').removeClass('hover');
        next();
    });
});
