/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
const $ = require('jquery');
require('bootstrap');
require('../scss/app.scss');

// any CSS you import will output into a single css file (app.css in this case)

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
$(document).ready(function () {
    $('[data-toggle = "popover"]').popover();

});
