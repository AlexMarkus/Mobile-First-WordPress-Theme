/*! Theme script © AlexMarkus */

// Replace the no-js class wit a js class
document.documentElement.className = document.documentElement.className.replace('no-js', 'js');

// Console.log fallback
if (typeof console === "undefined" || typeof console.log === "undefined") {
	console = {};
	console.log = function () { };
}

// Modernizr
if (typeof Modernizr === 'object') {
}

// Remove tap delay on touch enabled devices
if (typeof FastClick === 'function' && typeof window.addEventListener != "undefined") {
	window.addEventListener('load', function() {
		FastClick.attach(document.body);
	}, false);
}

// Toggle navigation on click
if (typeof document.querySelector === 'function') {
	document.querySelector('.skip-nav a').onclick = function() {
		document.querySelector('#nav').classList.toggle('show');
		return false;
	}
} else {
	document.getElementById('nav').className += ' show';
	document.getElementById('skip-nav').className += ' hide';
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

