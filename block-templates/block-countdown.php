<?php

/**
 * Countdown Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}
// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-block';
$className .= ' countdown';
$className .= ' d-flex flex-column flex-wrap flex-md-row justify-items-center';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
$section_anchor = $id;


// values
$countdown_date = get_field ('date_to_count');

?>

<div id="countdown"></div>

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
  document.getElementById('countdown').innerHTML = '<div class="d-flex flex-row"><div class="col">' + days + '<span class="label"></br>dagar</span></div>' + '<div class="col">' + hours + '<span class="label"></br>timmar</span></div>' + '<div class="col">' + minutes + '<span class="label"></br>minuter</span></div>' + '<div class="col">' + seconds + '<span class="label"></br>sekunder</span></div></div>';

  // If the count down is over, write some text
  if (distance < 0) {
	clearInterval(x);
	document.getElementById('countdown').innerHTML = 'EXPIRED';
  }
}, 1000);
</script>
