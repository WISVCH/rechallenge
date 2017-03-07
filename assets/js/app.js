Foundation.Orbit.defaults.navButtons = false;


// @TODO: only use Foundation plug-ins actually in use
jQuery(document).foundation();


jQuery(function ($) {

	$("a[data-open]").on('click tap', function (e) {
		e.preventDefault();
	})

})