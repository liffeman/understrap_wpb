<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function understrap_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
		);
		$posted_on   = apply_filters(
			'understrap_posted_on',
			sprintf(
				'<span class="posted-on">%1$s</span>',
				apply_filters( 'understrap_posted_on_time', $time_string )
			)
		);
		echo $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'understrap_entry_header' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function understrap_entry_header() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ' ', 'understrap' ) );
			if ( $categories_list && understrap_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<div class="cat-links">' . $categories_list . '</div>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		};
	}
}

if ( ! function_exists( 'understrap_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function understrap_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<div class="tags-links">' . $tags_list . '</div>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			//$author = get_the_author();
			$author = get_the_author_meta( 'display_name' );
			$user_email = get_the_author_meta( 'user_email' );

			if ( $author ) {
				/* translators: %s: Tags of current post */
				printf( '<div class="author-meta">' . $author . ', '. $user_email . '</div>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'understrap' ), esc_html__( '1 Comment', 'understrap' ), esc_html__( '% Comments', 'understrap' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'understrap' ),
				the_title( '<span class="sr-only">"', '"</span>', false )
			),
			'<div class="edit-link">',
			'</div>'
		);
	}
}

if ( ! function_exists( 'understrap_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function understrap_categorized_blog() {
		$all_the_cool_cats = get_transient( 'understrap_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'understrap_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so understrap_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so understrap_categorized_blog should return false.
			return false;
		}
	}
}

add_action( 'edit_category', 'understrap_category_transient_flusher' );
add_action( 'save_post', 'understrap_category_transient_flusher' );

if ( ! function_exists( 'understrap_category_transient_flusher' ) ) {
	/**
	 * Flush out the transients used in understrap_categorized_blog.
	 */
	function understrap_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'understrap_categories' );
	}
}

if ( ! function_exists( 'understrap_body_attributes' ) ) {
	/**
	 * Displays the attributes for the body element.
	 */
	function understrap_body_attributes() {
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique( apply_filters( 'understrap_body_attributes', $atts = array() ) );
		if ( ! is_array( $atts ) || empty( $atts ) ) {
			return;
		}
		$attributes = '';
		foreach ( $atts as $name => $value ) {
			if ( $value ) {
				$attributes .= sanitize_key( $name ) . '="' . esc_attr( $value ) . '" ';
			} else {
				$attributes .= sanitize_key( $name ) . ' ';
			}
		}
		echo trim( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}


if ( ! function_exists( 'understrap_category_filter' ) ) {
	function understrap_category_filter() {
	$args = array(
		//'show_option_all'   => '',
		//'show_option_none'  => '',
		'orderby'           => 'name',
		'order'             => 'ASC',
		//'show_count'        => 0,
		//'hide_empty'        => true,
		//'exclude'           => '1',
		//'hierarchical'      => 0,
		//'depth'             => 1,
		//'number'            => 12,
		'parent'  => 0
		);

	$categories = get_categories( $args );
    ?>
	<div class="cat-list flex-wrap" role="group" aria-label="Category button group">
	  <a class="cat-list_item btn btn-primary" role="button" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" data-slug="">Alla</a>
	  <?php foreach($categories as $category) : ?>
		  <a class="cat-list_item btn btn-dark" role="button" href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>" data-slug="<?= $category->slug; ?>">
			  <?= $category->name; ?>
			</a>
		<?php endforeach; ?>
		</div>
 	 <?php }
 }



// Showing the list of child pages
// Check if current page has children pages
if ( ! function_exists( 'understrap_subpage_nav' ) ) {
	function understrap_subpage_nav() {
	$id = get_the_ID();
	$postID = get_queried_object_id();
	$children = get_pages('child_of='.$post->ID.'&parent='.$post->ID);

	// if current page got children pages :
	if (sizeof($children) > 0){
		$args = array(
			'post_status'       => ' publish',
			'post_type'         => 'page',
			'posts_per_page'    => -1,
			'post_parent'       => $post->ID,
			'order'             => 'ASC',
			'orderby'           => 'date',
		);
	}

	$parent = new WP_Query( $args );

		// Showing a list in the template
	if ( $parent->have_posts() ):
	?>
			<nav class="subpage-list">
				<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
					<a class="item-from-list" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a>
				<?php endwhile; ?>
			</nav>
	<?php wp_reset_query(); ?>
	<?php endif ;?>
	<?php
	}
}
