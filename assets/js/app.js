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

// external js: packery.pkgd.js
$('.grid').masonry({
    // options
    itemSelector: '.grid-item',
    columnWidth: 200
});

var elem = document.querySelector('.grid');
var msnry = new Masonry( elem, {
    // options
    itemSelector: '.grid-item',
    columnWidth: 200
});

// element argument can be a selector string
//   for an individual element
var msnry = new Masonry( '.grid', {
    // options
});


var grid = document.querySelector('.grid');
var pckry = new Packery( grid, {
    itemSelector: '.grid-item',
    percentPosition: true
});

grid.addEventListener( 'click', function( event ) {
    // only .grid-item-content clicks
    if ( !matchesSelector( event.target, '.grid-item-content' ) ) {
        return;
    }

    var itemContent = event.target;
    setItemContentPixelSize( itemContent );

    var itemElem = itemContent.parentNode;

    var isExpanded = itemElem.classList.contains('is-expanded');
    itemElem.classList.toggle('is-expanded');

    // force redraw
    var redraw = itemContent.offsetWidth;
    // renable default transition
    itemContent.style[ transitionProp ] = '';

    addTransitionListener( itemContent );
    setItemContentTransitionSize( itemContent, itemElem );

    if ( isExpanded ) {
        // if shrinking, shiftLayout
        pckry.shiftLayout();
    } else {
        // if expanding, fit it
        pckry.fit( itemElem );
    }
});

var docElem = document.documentElement;
var transitionProp = typeof docElem.style.transition == 'string' ?
    'transition' : 'WebkitTransition';
var transitionEndEvent = {
    WebkitTransition: 'webkitTransitionEnd',
    transition: 'transitionend'
}[ transitionProp ];

function setItemContentPixelSize( itemContent ) {
    var previousContentSize = getSize( itemContent );
    // disable transition
    itemContent.style[ transitionProp ] = 'none';
    // set current size in pixels
    itemContent.style.width = previousContentSize.width + 'px';
    itemContent.style.height = previousContentSize.height + 'px';
}

function addTransitionListener( itemContent ) {
    // reset 100%/100% sizing after transition end
    var onTransitionEnd = function() {
        itemContent.style.width = '';
        itemContent.style.height = '';
        itemContent.removeEventListener( transitionEndEvent, onTransitionEnd );
    };
    itemContent.addEventListener( transitionEndEvent, onTransitionEnd );
}

function setItemContentTransitionSize( itemContent, itemElem ) {
    // set new size
    var size = getSize( itemElem );
    itemContent.style.width = size.width + 'px';
    itemContent.style.height = size.height + 'px';
}



