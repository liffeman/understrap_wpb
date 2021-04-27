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
$countdown_weather = get_field('weather');
$countdown_link = get_field('sidlank');
if( $countdown_link ){
	$link_url = $countdown_link['url'];
	$link_title = $countdown_link['title'];
	$link_target = $countdown_link['target'] ? $countdown_link['target'] : '_self';
}
$show_link = get_field('show_link');

$date_now = date('Y-m-d H:i:s');
$time_now = strtotime($date_now);
//$countdown_now = date('F j, Y H:i:s', strtotime($countdown_date);
$countdown_now = strtotime($countdown_date);
$countdown_print = date('F j, Y H:i:s', strtotime($countdown_date));


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
		<div class="d-none">
			<?php
			echo '<p><label>$countdown_date: ' .  $countdown_date . '</p>';
			echo '<p><label>$countdown_now: ' .  $countdown_now . '</p>';
			echo '<p><label>$countdown_print: ' .  $countdown_print . '</p>';
			echo '<p><label>$date_now: ' .  $date_now . '</p>';
			echo '<p><label>$time_now: ' .  $time_now . '</p>';
			?>
		</div>
		<div id="countdown" class="countdown-content p-0 px-md-5"></div>

		<?php if($countdown_weather): ?>

			<?php
			$weather_url = 'https://api.openweathermap.org/data/2.5/weather?q='. $countdown_weather . '&units=metric&lang=sv&appid=0ac0c1d7df67ef6e7bf7f532815f01b5';
			$string = file_get_contents($weather_url);
			$json_a = json_decode($string,true);

			$w_place = $json_a['name'];
			$w_desc = $json_a['weather']['0']['description'];
			$w_temp =  $json_a['main']['temp'];
			$w_feels = $json_a['main']['feels_like'];
			$w_id = $json_a['weather']['0']['id'];
			$w_icon = $json_a['weather']['0']['icon'];
			$w_default_icon = '<img src="https://openweathermap.org/img/wn/' . $json_a['weather']['0']['icon'] . '@2x.png">';

			$w_fa_icon = $w_icon;

			switch ($w_icon) {
				case "01d":
					$w_fa_icon = 'sun';
					break;
				case "01n":
					$w_fa_icon = 'moon';
					break;
				case "02d":
					$w_fa_icon = 'clouds-sun';
					break;
				case "02n":
					$w_fa_icon = 'clouds-moon';
					break;
				case "03d":
					$w_fa_icon = 'cloud';
					break;
				case "03n":
					$w_fa_icon = 'cloud';
					break;
				case "04d":
					$w_fa_icon = 'clouds';
					break;
				case "04n":
					$w_fa_icon = 'clouds';
					break;
				case "09d":
					$w_fa_icon = 'cloud-showers';
					break;
				case "09n":
					$w_fa_icon = 'cloud-showers';
					break;
				case "10d":
					$w_fa_icon = 'cloud-rain';
					break;
				case "10n":
					$w_fa_icon = 'cloud-rain';
					break;
				case "11d":
					$w_fa_icon = 'thunderstorm';
					break;
				case "11n":
					$w_fa_icon = 'thunderstorm';
					break;
				case "13d":
					$w_fa_icon = 'snowflake';
					break;
				case "13n":
					$w_fa_icon = 'snowflake';
					break;
				case "50d":
					$w_fa_icon = 'fog';
					break;
				case "50n":
					$w_fa_icon = 'fog';
					break;
				default:
					$w_fa_icon = 'temperature-low';
				}

			$weather_icon = '<i class="fas fa-' .$w_fa_icon .' fa-4x"></i>';

			$weather_widget = '<div class="weather-widget">	<div class="weather-location">'. $w_place . '</div><div class="weather-content"><div class="weather-symbol">'.$weather_icon.'</div><div class="weather-body"><div class="weather-cond">' . ucfirst($w_desc).'</div>	<div class="weather-temp">' . round($w_temp, 0).'° <span class="weather-temp-feel">(Känns som '. round($w_feels,0).'°)</span></div></div></div></div>';

			echo $weather_widget;
			?>

		<?php endif ;?>
		</div>


		<?php if ($countdown_link) {
			$btn_color = ' btn-outline-';
			if (strpos($countdown_color, 'bg-light' ) !== false) {
				$btn_color .= 'dark';
			} else {
				$btn_color .= 'light';
			}
				if ($countdown_now > $time_now) {
					if (! $show_link) {
						echo '<div class="countdown-link"><a class="btn btn-lg'.$btn_color.'" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ). '</a></div>';
					}
				} else {
					echo '<div class="countdown-link"><a class="btn btn-lg'.$btn_color.'" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ). '</a></div>';
				}
			}
		?>
	</div>
</div>

<?php
$after_event = '';
if ($countdown_msg ){
	$after_event .= '<div class="message col">' . $countdown_msg . '</div>';
}
//echo '<pre>' . print_r($json_a, true) . '</pre>';

?>

<script>
	// Set the date we're counting down to
	//var countDownDate = new Date("2021-04-05 14:08:00").getTime();
	var countDownDate = new Date('<?php echo $countdown_print; ?>').getTime();
	//var countDownDate = '<?php echo $countdown_now; ?>';

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
		document.getElementById('countdown').innerHTML = '<?php echo $after_event; ?>';
	  }
	}, 1000);
	</script>
