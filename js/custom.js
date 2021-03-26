jQuery(function($){
	$('.carousel-item:first').addClass('active');

	$(window).load(function(e) {
		$('[data-src]').each(function(index, element) {
			$(element).attr('src', $(element).attr('data-src'));
		});
	});
});
