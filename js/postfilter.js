/**
 * post filter.js.
 *
 */
( function( $ ) {

$('.cat-list_item').on('click', function() {
	  $('.cat-list_item').removeClass('active');
	  $(this).addClass('active');
	  '&base=' + location.hostname + location.pathname;

	  $.ajax({
		type: 'POST',
		url: '/wp/wp-admin/admin-ajax.php',
		dataType: 'html',
		data: {
		  action: 'filter_projects',
		  category: $(this).data('slug'),
		},
		success: function(res) {
		  $('.post-tiles').html(res);
		}
	  })
	});
} )( jQuery );
