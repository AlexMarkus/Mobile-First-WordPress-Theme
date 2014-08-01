
// Add a js-class to html element
document.documentElement.className = document.documentElement.className.replace('no-js', 'js');

// Remove tap delay on touch enabled devices
if (typeof FastClick === 'function') {
	window.addEventListener('load', function() {
		FastClick.attach(document.body);
	}, false);
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
			top      : 'top',
		},
	});
	headroom.init();
}