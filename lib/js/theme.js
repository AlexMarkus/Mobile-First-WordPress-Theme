/*! Theme script © AlexMarkus */

// Console.log fallback
if (typeof console === "undefined" || typeof console.log === "undefined") {
	console = {};
	console.log = function () { };
}

// Add a js-class to html element
document.documentElement.className = document.documentElement.className.replace('no-js', 'js');

// Modernizr
if (typeof Modernizr === 'object') {

	// Test and load respond.js
	Modernizr.load({
		test: Modernizr.mq('only all'),
		nope: theme.template_uri + '/lib/js/respond.min.js'
	});

}

// Remove tap delay on touch enabled devices
if (typeof FastClick === 'function') {
	window.addEventListener('load', function() {
		FastClick.attach(document.body);
	}, false);
}

// Toggle navigation on click
if (typeof document.querySelector === 'function') {
	document.querySelector('.skip-nav a').onclick = function() {
		document.querySelector('#nav').classList.toggle('show');
		return false;
	};
}

// Setup headroom
if (typeof Headroom === 'function') {
	var headroomElement = document.querySelector('.header');
	// Setup the headroom options on the element
	var headroom  = new Headroom(headroomElement, {
		classes : {
			initial  : 'headroom',
			unpinned : 'unpinned',
			pinned   : 'pinned',
			notTop   : 'not-top',
			top      : 'top'
		}
	});
	headroom.init();
}

