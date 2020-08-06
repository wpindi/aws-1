<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qik
 */

?>

<article id="post-<?php the_ID(); ?>" class="style-three post">
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="post-thumbnail matchHeight">
			<img src="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/no-image/No-Image-Found-400x264.png' ) ); ?>" alt="<?php echo esc_attr__( 'No Image Found', 'qik' ); ?>" width="400" height="264">
			<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
				<a class="placeholder" href="<?php the_permalink(); ?>" style="background-image:url('<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>')"></a>
			<?php endif; ?>
		</div><!-- .post-thumbnail -->
	</div>
	<?php } ?>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<?php } else { ?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php } ?>
		<div class="entry-main matchHeight">
			<header class="entry-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			</header><!-- .entry-header -->
			<div class="post-meta">
				<span class="date"><span class="author">By <?php echo get_the_author_link(); ?></span> |  <?php echo get_the_date(); ?></span>
				<?php if ( true == radiantthemes_global_var( 'display_categries', '', false ) ) : ?>
					<span class="category-list">
						<?php echo esc_html__('In', 'qik'); ?>
						<?php
						$category_detail = get_the_category( get_the_id() );
						$result          = '';
						foreach ( $category_detail as $item ) :
							$category_link = get_category_link( $item->cat_ID );
							$result       .= '<a href = "' . esc_url( $category_link ) . '">' . $item->name . '</a>';
						endforeach;
						echo wp_kses_post( $result );
						?>
					</span>
				<?php endif; ?>
			</div><!-- .post-meta -->
			<div class="entry-content">
				<p><?php echo wp_kses_post( substr( strip_tags( get_the_excerpt() ), 0, 120 ) . '...' ); ?></p>
			</div><!-- .entry-content -->
		</div><!-- .entry-main -->
	</div>
</article><!-- #post-## -->
