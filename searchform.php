<?php
/**
 * The template for displaying search forms
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label class="sr-only" for="s"><?php esc_html_e( 'Search', 'understrap' ); ?></label>
	<div class="input-group">
		<input class="field form-control form-control-lg" id="s" name="s" type="text"
			placeholder="<?php esc_attr_e( 'Search &hellip;', 'understrap' ); ?>" value="<?php the_search_query(); ?>">
		<span class="input-group-append">
			<button class="submit btn btn-outline-dark px-3" id="searchsubmit" name="submit" type="submit"><i class="fas fa-search"></i></button>
		</span>
	</div>
</form>
