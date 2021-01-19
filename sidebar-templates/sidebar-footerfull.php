<?php
/**
 * Sidebar setup for footer full
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full">

		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer',
						//'container_class' => 'navbar',
						//'container_id'    => 'footer_menu',
						'menu_class'      => 'nav justify-content-center',
						'fallback_cb'     => '',
						'menu_id'         => 'footer-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>

				<?php dynamic_sidebar( 'footerfull' ); ?>

			</div>
			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<p class="footer-copyright text-muted text-center small">&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://secure.php.net/date */
								_x( 'Y', 'copyright date format', 'understrap' )
							);
							?>
							<a class="text-light" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo bloginfo( 'name' ); ?></a></p>


					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div>

	</div><!-- #wrapper-footer-full -->

	<?php
endif;
