<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qik
 */

?>
<article id="post-<?php the_ID(); ?>" class="blog-item style-one post">
	<div class="holder">
		<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="pic">
			<a class="pic-main" href="<?php the_permalink(); ?>" style="background-image:url(<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>);"></a>
		</div>
	<?php endif; ?>
	<div class="data">
		<ul class="meta">
			<li class="date"><?php the_time( 'F j, Y' ); ?></li>
		</ul>
		<h4 class="title">
			<a href="<?php the_permalink(); ?>"><?php the_title() ;?></a>
		</h4>
		<a class="btn" href="<?php the_permalink(); ?>"><span>Read More</span></a>
	</div>
</div>
</article>




