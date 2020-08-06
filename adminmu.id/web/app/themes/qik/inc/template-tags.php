<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package qik
 */

if ( ! function_exists( 'radiantthemes_global_var' ) ) {
	/**
	 * [radiantthemes_global_var description]
	 *
	 * @param  [type] $qik_opt_one   description.
	 * @param  [type] $qik_opt_two   description.
	 * @param  [type] $qik_opt_check description.
	 * @return [type]                          description
	 */
	function radiantthemes_global_var(
		$qik_opt_one,
		$qik_opt_two,
		$qik_opt_check
	) {
		global $qik_theme_option;
		if ( $qik_opt_check ) {
			if ( isset( $qik_theme_option[ $qik_opt_one ][ $qik_opt_two ] ) ) {
				return $qik_theme_option[ $qik_opt_one ][ $qik_opt_two ];
			}
		} else {
			if ( isset( $qik_theme_option[ $qik_opt_one ] ) ) {
				return $qik_theme_option[ $qik_opt_one ];
			}
		}
	}
}



if ( ! function_exists( 'radiantthemes_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function radiantthemes_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string  = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$author_image = sprintf(
			get_avatar( get_the_author_meta( 'email' ), '150' )
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'qik' ),
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span data-hover="' . esc_attr( get_the_author() ) . '">' . esc_html( get_the_author() ) . '</span></a>'
		);

		$published_on = sprintf(
			/*
			 translators: %s: post date. */
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span data-hover="' . esc_html( get_the_date() ) . '">' . esc_html( get_the_date() ) . '</span></a>'
		);

				printf(
					wp_kses(
						'<div class="holder">
                            <div class="author-image hidden">' . $author_image . '</div>
                                <div class="data">
                                    <div class="meta">', 'post'
					)
				);

					printf(
						wp_kses(
							'<span class="published-on"> ' . esc_html__( 'Posted on', 'qik' ) . ' ' . $published_on . '</span>
    						<span class="byline"> ' . esc_html__( 'By', 'qik' ) . ' ' . $byline . '</span>', 'post'
						)
					);

					// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
				if ( is_single() ) {
					/* translators: used between list items, there is a space after the comma */
					if ( true == radiantthemes_global_var( 'display_categries', '', false ) ) :
						$categories_list = get_the_category_list( __( ', ', 'qik' ) );
						if ( $categories_list && radiantthemes_categorized_blog() ) {
									printf(
										wp_kses( '<span class="category"><span class="ti-direction-alt"></span> ' . esc_html__( 'In', 'qik' ) . '', 'post' ) .
										/* translators: used between list items, there is a space after the comma */
										esc_html( ' %1$s' ) .
										wp_kses( '</span>', 'post' ),
										wp_kses( $categories_list, 'post' )
									);
						}
								endif;
				}
			}

				echo ' </div>
			</div>
		</div>';

	}
endif;
function radiantthemes_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'qik_categories' ) ) ) {
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

		set_transient( 'qik_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so radiantthemes_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so radiantthemes_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in radiantthemes_categorized_blog.
 */
function radiantthemes_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'qik_categories' );
}
add_action( 'edit_category', 'radiantthemes_category_transient_flusher' );
add_action( 'save_post', 'radiantthemes_category_transient_flusher' );
