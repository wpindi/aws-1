<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qik
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'style-default' ); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
		</div><!-- .post-thumbnail -->
	<?php } ?>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-meta">
		<?php radiantthemes_posted_on(); ?>
	</div><!-- .entry-meta -->
	<div class="entry-main">
		<div class="entry-content">
			<?php echo wp_kses_post( substr( wp_strip_all_tags( get_the_excerpt() ), 0, 400 ) . '...' ); ?>
		</div><!-- .entry-content -->
		<div class="row entry-extra">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="entry-extra-item text-left">
					<div class="post-read-more">
						<a class="btn" href="<?php the_permalink(); ?>" data-hover="<?php esc_attr_e( 'Read More', 'qik' ); ?>"><span><?php esc_html_e( 'Read More', 'qik' ); ?></span></a>
					</div><!-- .post-read-more -->
				</div><!-- .entry-extra-item -->
			</div>
		</div><!-- .entry-extra -->
	</div><!-- .entry-main -->
</article><!-- #post-## -->
