<?php

/**
 * Countdown Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
// ACF values

// values
$countdown_title = get_field ('event_title');
$countdown_img = get_field ('event_logo');
$countdown_img_size = 'full'; // (thumbnail, medium, large, full or custom size)
$countdown_date = get_field ('date_to_count');
$countdown_msg = get_field ('event_message');
$countdown_color = get_field ('event_color');

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block';
$className .= ' countdown';
$className .= ' d-flex flex-column flex-wrap justify-items-center mt-3 mb-3';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
$className .= ' ' .$countdown_color;

$section_anchor = $id;

?>
<?php if( !empty($section_anchor) ){
echo '<a class="anchor" id="' . $section_anchor . '"></a>';
}
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="container">
		<?php if ( $countdown_title)  {
			echo '<h2 class="countdown-title">' . $countdown_title . '</h2>';
		}
		?>
		<div class="d-flex flex-column  flex-md-row align-items-center">
		<?php if( $countdown_img ) {
			echo '<div class="event-logo">';
			echo wp_get_attachment_image( $countdown_img, $countdown_img_size );
			echo '</div>';
			}
		?>
		<div id="countdown" class="countdown-content p-0 p-md-5"></div>
		</div>
	</div>
</div>


<script>
	// Set the date we're counting down to
	//var countDownDate = new Date('Jan 5, 2021 15:37:25').getTime();
	var countDownDate = new Date('<?php echo $countdown_date; ?>').getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

	  // Get today's date and time
	  var now = new Date().getTime();

	  // Find the distance between now and the count down date
	  var distance = countDownDate - now;

	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  // Output the result in an element with id="demo"
	  document.getElementById('countdown').innerHTML = '<div class="d-flex flex-md-row flex-row flex-wrap"><div class="col">' + days + '<span class="label">dagar</span></div>' + '<div class="col">' + hours + '<span class="label">timmar</span></div>' + '<div class="col">' + minutes + '<span class="label">minuter</span></div>' + '<div class="col">' + seconds + '<span class="label">sekunder</span></div></div>';

	  // If the count down is over, write some text
	  if (distance < 0) {
		clearInterval(x);
		document.getElementById('countdown').innerHTML = '<?php echo $countdown_msg; ?>';
	  }
	}, 1000);
	</script>
