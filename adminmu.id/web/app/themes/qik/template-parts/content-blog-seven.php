<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package qik
 */

?>

<div class="rt-grid">
  <div class="rt-image-box">
    <a href="<?php echo esc_url( get_permalink() ) ;?>"><img src="<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>"></a>
  </div>
  <div class="rt-bottom-left">
    <div class="radiant_lifestyle_trans_bg">

      <div class="radiant-masonory-category">
        <p>By <?php the_author(); ?> | <span><?php the_time(' F jS, Y'); ?></span></p>
      </div>
      <h3><a href="<?php echo esc_url( get_permalink() ) ;?>"><?php echo the_title() ;?></a></h3>
      <a class="transparent-masionary-btn-hover" href="<?php echo esc_url( get_permalink() ) ;?>"><span>Read More</span></a>            
    </div><!--radiant_lifestyle_trans_bg-->
    
  </div><!--bottom-left-->
  
</div><!--rt-grid-->



