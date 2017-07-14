$(document).ready(() => {
	let menu = $('#menu');

	menu.click(() => {
		let nav = $('nav');

		if(nav.hasClass('active')) {
			menu.removeClass('active');
			nav.removeClass('active');
		} else {
			menu.addClass('active');
			nav.addClass('active');
		}
	});
});