<?php
/**
 * Dynamic CSS Propoerty Based on Theme Options
 *
 * @package qik
 */

$font_face = '';

$theme_options = get_option( 'qik_theme_option' );
for ( $i = 0; $i <= 50; $i++ ) {
	if ( ! empty( $theme_options[ 'webfontName' . $i ] ) ) {
		$font_name = $theme_options[ 'webfontName' . $i ];

		$urls = array();
		if ( ! empty( $theme_options[ 'woff' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'woff' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'woffTwo' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'woffTwo' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'ttf' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'ttf' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'svg' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'svg' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'eot' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'eot' . $i ]['url'] ) . ')';
		}

		$font_face .= '@font-face {' . "\n";
		$font_face .= 'font-family:"' . esc_attr( $font_name ) . '";' . "\n";
		$font_face .= 'src:';
		$font_face .= implode( ', ', $urls ) . ';';
		$font_face .= '}' . "\n";
	}
}
echo wp_kses( $font_face, 'post' );

$color_solid = '';
$color_rgba  = '';
?>
<?php
if ( isset( $radiantthemes_theme_options['body-typekit'] ) && $radiantthemes_theme_options['active_typekit'] ) {
	if ( $radiantthemes_theme_options['body-typekit'] ) {
		?>
body{
		<?php if ( ! empty( $radiantthemes_theme_options['body-typekit'] ) ) : ?>
	font-family: "<?php echo esc_attr( $radiantthemes_theme_options['body-typekit'] ); ?>";
}
			<?php
			if ( isset( $radiantthemes_theme_options['heading-typekit'] ) && $radiantthemes_theme_options['active_typekit'] ) {
				if ( $radiantthemes_theme_options['heading-typekit'] ) {
					?>
h1, h2, h3, h4, h5, h6, .inner_banner_main .title {
					<?php if ( ! empty( $radiantthemes_theme_options['heading-typekit'] ) ) : ?>

	font-family: "<?php echo esc_attr( $radiantthemes_theme_options['heading-typekit'] ); ?>";
	<?php endif; ?>
}
					<?php if ( ! empty( $radiantthemes_theme_options['heading-typekit'] ) ) : ?>
	 .rt-pricing-table > .holder > .pricing > .price, .radiantthemes-accordion .text {
	font-family: "<?php echo esc_attr( $radiantthemes_theme_options['heading-typekit'] ); ?>";
	}
	<?php endif; ?>
					<?php
				}
			}
			?>
	<?php endif; ?>

		<?php
	}
}
?>


<?php

/*
--------------------------------------------------------------
>>> THEME COLOR SCHEME CSS || DO NOT CHANGE THIS WITHOUT PROPER KNOWLEDGE
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
// RadiantThemes Website Layout
// RadiantThemes Custom
// RadiantThemes Header Style
	// RadiantThemes Header Style One
	// RadiantThemes Header Style Two
	// RadiantThemes Header Style Six
	// RadiantThemes Header Style Sixteen
// RadiantThemes Inner Banner Style
--------------------------------------------------------------
*/

/*
--------------------------------------------------------------
// RadiantThemes Website Layout
--------------------------------------------------------------
*/
?>


.wraper_header .wraper_header_main .header_main .brand-logo img, .wraper_header .wraper_header_main .header_main .brand-logo-sticky img{
	max-width: <?php echo esc_attr( $radiantthemes_theme_options['header_logo_width'] ); ?>px !important;
	height: <?php echo esc_html( $radiantthemes_theme_options['header_logo_height']['margin-top'] ); ?>;
}
<?php
	  $margin        = '';
			$margin  = $radiantthemes_theme_options['header_nav_margin']['margin-top'];
			$margin .= ' ' . $radiantthemes_theme_options['header_nav_margin']['margin-right'];
			$margin .= ' ' . $radiantthemes_theme_options['header_nav_margin']['margin-bottom'];
			$margin .= ' ' . $radiantthemes_theme_options['header_nav_margin']['margin-left'];
?>
.wraper_header .wraper_header_main .nav, .wraper_header .wraper_header_main .header-hamburger-menu {
	margin: <?php echo esc_html( $margin ); ?> !important;
}

.radiantthemes-website-layout.boxed{
	max-width: <?php echo esc_attr( $radiantthemes_theme_options['layout_type_boxed_width'] ); ?>px ;
}

@media (min-width: 1200px){

	.radiantthemes-website-layout.boxed .container{
		width: calc( <?php echo esc_attr( $radiantthemes_theme_options['layout_type_boxed_width'] ); ?>px - 30px) ;
	}

	.radiantthemes-website-layout.boxed .container.page-container{
		width: <?php echo esc_attr( $radiantthemes_theme_options['layout_type_boxed_width'] ); ?>px ;
	}

}

.radiantthemes-website-layout.boxed .container-fluid{
	max-width: calc( <?php echo esc_attr( $radiantthemes_theme_options['layout_type_boxed_width'] ); ?>px - 30px) ;
}







<?php

/*
--------------------------------------------------------------
// RadiantThemes Header Style
--------------------------------------------------------------
*/

/*
--------------------------------------------------------------
// RadiantThemes Header Style One
--------------------------------------------------------------
*/
?>

body[data-header-style='header-style-one'] #hamburger-menu{
	max-width: <?php echo esc_attr( $radiantthemes_theme_options['header_one_hamburger_width'] ); ?>px ;
}

body[data-header-style='header-style-one'] #hamburger-menu.right{
	right: -<?php echo esc_attr( $radiantthemes_theme_options['header_one_hamburger_width'] ); ?>px ;
}

<?php

/*
--------------------------------------------------------------
// RadiantThemes Header Style Two
--------------------------------------------------------------
*/
?>

body[data-header-style='header-style-two'] #hamburger-menu{
	max-width: <?php echo esc_attr( $radiantthemes_theme_options['header_two_hamburger_width'] ); ?>px ;
}

body[data-header-style='header-style-two'] #hamburger-menu.right{
	right: -<?php echo esc_attr( $radiantthemes_theme_options['header_two_hamburger_width'] ); ?>px ;
}

<?php

/*
--------------------------------------------------------------
// RadiantThemes Header Style Six
--------------------------------------------------------------
*/
?>

body[data-header-style='header-style-six'] #hamburger-menu{
	max-width: <?php echo esc_attr( $radiantthemes_theme_options['header_six_hamburger_width'] ); ?>px ;
}

body[data-header-style='header-style-six'] #hamburger-menu.right{
	right: -<?php echo esc_attr( $radiantthemes_theme_options['header_six_hamburger_width'] ); ?>px ;
}

<?php

/*
--------------------------------------------------------------
// RadiantThemes Header Style Sixteen
--------------------------------------------------------------
*/
?>

body[data-header-style='header-style-sixteen'] #hamburger-menu{
	max-width: <?php echo esc_attr( $radiantthemes_theme_options['header_sixteen_hamburger_width'] ); ?>px ;
}

body[data-header-style='header-style-sixteen'] #hamburger-menu.right{
	right: -<?php echo esc_attr( $radiantthemes_theme_options['header_sixteen_hamburger_width'] ); ?>px ;
}

<?php

/*
--------------------------------------------------------------
// RadiantThemes Inner Banner Style
--------------------------------------------------------------
*/
?>

.wraper_inner_banner_main .inner_banner_main{
	text-align: <?php echo esc_attr( $radiantthemes_theme_options['inner_page_banner_alignment'] ); ?> ;
}

.wraper_inner_banner_breadcrumb .inner_banner_breadcrumb{
	text-align: <?php echo esc_attr( $radiantthemes_theme_options['breadcrumb_alignment'] ); ?> ;
}






