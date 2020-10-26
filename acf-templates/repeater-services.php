<?php if( have_rows('services') ): ?>

	<?php while ( have_rows('services') ) : the_row(); ?>

	<?php
		$service_title = get_sub_field('service_title');
		$service_image = get_sub_field('service_image');
		$service_link = get_sub_field('service_link');

	?>

		<div class="col text-center">
			<div class="service-card">
				<div class="service-icon">
				<?php echo $service_image ;?>
				</div>
				<?php
					if  ($service_link):
						$link_url = $service_link['url'];
						//$link_title = $link['title'];
						$link_target = $service_link['target'] ? $service_link['target'] : '_self';
				?>
				<h5 class="service-title text-center"><a class="service-link stretched-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $service_title ); ?></a>
				<?php else: ?>
				<h5 class="service-title text-center"><?php echo $service_title; ?>
				<?php endif; ?>
				</h5>
			</div>
		</div>

	<?php endwhile; ?>

<?php endif; ?>
