	<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package qik
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
	<?php wp_body_open(); ?>
	<?php
	if ( class_exists( 'Radiantthemes_Addons' ) ) {
		if ( ! is_user_logged_in() && ! empty( radiantthemes_global_var( 'coming_soon_switch', '', false ) ) ) {
			include ABSPATH . 'wp-content/plugins/radiantthemes-addons/coming-soon.php';
			die;
		} elseif ( ! is_user_logged_in() && ! empty( radiantthemes_global_var( 'maintenance_mode_switch', '', false ) ) ) {
			include ABSPATH . 'wp-content/plugins/radiantthemes-addons/maintenance.php';
			die;
		} elseif ( ! is_user_logged_in() && ! empty( radiantthemes_global_var( 'coming_soon_switch', '', false ) ) && ! empty( radiantthemes_global_var( 'maintenance_mode_switch', '', false ) ) ) {
			include ABSPATH . 'wp-content/plugins/radiantthemes-addons/coming-soon.php';
			die;
		}
	}
	?>


	<?php if ( radiantthemes_global_var( 'preloader_switch', '', false ) ) { ?>
		<!-- preloader -->
		<div class="preloader" data-preloader-timeout="<?php echo esc_attr( radiantthemes_global_var( 'preloader_timeout', '', false ) ); ?>">
			<?php
			if ( ! empty( radiantthemes_global_var( 'preloader_style', '', false ) ) ) {
				include get_parent_theme_file_path( 'inc/preloader/' . radiantthemes_global_var( 'preloader_style', '', false ) . '.php' );
			}
			?>
		</div>
		<!-- preloader -->
		<?php
	}
	?>

	<!-- overlay -->
	<div class="overlay"></div>
	<!-- overlay -->

	<!-- scrollup -->
	<?php if ( radiantthemes_global_var( 'scroll_to_top_switch', '', false ) ) { ?>
		<?php if ( ! empty( radiantthemes_global_var( 'scroll_to_top_direction', '', false ) ) ) : ?>
			<div class="scrollup <?php echo esc_attr( radiantthemes_global_var( 'scroll_to_top_direction', '', false ) ); ?>">
		<?php else : ?>
			<div class="scrollup left">
		<?php endif; ?>
			<span class="ti-angle-up"></span>
		</div>
	<?php } ?>
	<!-- scrollup -->

	<!-- radiantthemes-website-layout -->
	<?php if ( class_exists( 'Redux' ) ) { ?>
		<?php if ( 'full-width' === radiantthemes_global_var( 'layout_type', '', false ) ) { ?>
			<div class="radiantthemes-website-layout full-width">
		<?php } elseif ( 'boxed' === radiantthemes_global_var( 'layout_type', '', false ) ) { ?>
			<div class="radiantthemes-website-layout boxed">
		<?php } ?>
	<?php } else { ?>
		<div id="page" class="site full-width">
	<?php } ?>

		<?php
		$floating_header = get_post_meta( get_the_id(), 'new_custom_floating', true );
		?>

		<?php
		if ( true == radiantthemes_global_var( 'floating_header', '', false ) ) {
			if ( $floating_header == 0 || $floating_header == 1 ) {
				?>
		<header class="wraper_header floating-header">
				<?php
			} else {
				?>
		<header class="wraper_header">
				<?php
			}
		} else {
			?>
		<header class="wraper_header">
			<?php } ?>
			<?php
			if ( ! class_exists( 'Redux' ) ) {
				?>
			<?php } elseif ( is_404() || is_search() ) { ?>
				<?php
				$defaultthemeoptionsticky_id = radiantthemes_global_var( 'stiky_header_list_text', '', false );
				if ( $defaultthemeoptionsticky_id ) {
					?>
					<div class="sticky-header" data-delay="<?php echo esc_attr( radiantthemes_global_var( 'header_sticky_delay', '', false ) ); ?>">
						<?php echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $defaultthemeoptionsticky_id ); ?>
					</div>
				<?php } else { ?>
			<?php } ?>
			<?php } else { ?>
				<?php
				wp_reset_postdata();
				$stickyheader_id = get_post_meta( $post->ID, 'new_custom_sticky_header', true );
				if ( $stickyheader_id ) {
					?>
					<div class="sticky-header" data-delay="<?php echo esc_attr( radiantthemes_global_var( 'header_sticky_delay', '', false ) ); ?>">
						<?php
						$stickytemplate = get_page_by_path( $stickyheader_id, OBJECT, 'elementor_library' );
						echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $stickytemplate->ID );
						?>
					</div>
				<?php } else { ?>
					<?php
					$stickythemeoptions_id = radiantthemes_global_var( 'stiky_header_list_text', '', false );
					?>
					<?php if ( $stickythemeoptions_id ) { ?>
						<div class="sticky-header" data-delay="<?php echo esc_attr( radiantthemes_global_var( 'header_sticky_delay', '', false ) ); ?>">
							<?php
							echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $stickythemeoptions_id );
							?>
						</div>
					<?php } else { ?>
						<?php
					}
				}
			}
			?>

			<?php
			if ( ! class_exists( 'Redux' ) ) {
				include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			} elseif ( is_404() || is_search() ) {
				$defaultthemeoptions_id = radiantthemes_global_var( 'header_list_text', '', false );
				if ( $defaultthemeoptions_id ) {
					echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $defaultthemeoptions_id );
				} else {
					include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
				}
			} else {
				wp_reset_postdata();
				$headerBuilder_id = get_post_meta( $post->ID, 'new_custom_header', true );
				if ( $headerBuilder_id ) {
					?>
				<div class="main-header">
					<?php
					$template = get_page_by_path( $headerBuilder_id, OBJECT, 'elementor_library' );
					echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template->ID );
					?>
				</div>
				<?php } else { ?>
					<?php
					$headerbuilderthemeoptions_id = radiantthemes_global_var( 'header_list_text', '', false );
					?>
					<?php if ( $headerbuilderthemeoptions_id ) { ?>
				<div class="main-header">
						<?php
						echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $headerbuilderthemeoptions_id );
						?>
				</div>
				<?php } else { ?>
						<?php include get_parent_theme_file_path( 'inc/header/header-style-default.php' ); ?>
						<?php
				}
				}
			}
			?>
		</header>
			<?php
			$team_page_info           = '';
			$rt_team_bannercheck      = '';
			$portfolio_page_info      = '';
			$rt_portfolio_bannercheck = '';
			$case_studies_page_info   = '';
			$rt_case_studies_banner   = '';
			$rt_shop_banner           = '';
			$posts_page_id            = '';
			$rt_posts_page_bann       = '';

			if ( is_singular( 'team' ) || is_tax( 'profession' ) ) {
				$team_page_info = get_page_by_path( 'team', OBJECT, 'page' );
				if ( $team_page_info ) {
					$team_page_id        = $team_page_info->ID;
					$rt_team_bannercheck = get_post_meta( $team_page_id, 'bannercheck', true );
				}
			} elseif ( is_singular( 'portfolio' ) || is_tax( 'portfolio-category' ) ) {
				$portfolio_page_info = get_page_by_path( 'portfolio', OBJECT, 'page' );
				if ( $portfolio_page_info ) {
					$portfolio_page_id        = $portfolio_page_info->ID;
					$rt_portfolio_bannercheck = get_post_meta( $portfolio_page_id, 'bannercheck', true );
				}
			} elseif ( is_singular( 'case-studies' ) || is_tax( 'case-study-category' ) ) {
				$case_studies_page_info = get_page_by_path( 'case-studies', OBJECT, 'page' );
				if ( $case_studies_page_info ) {
					$case_studies_page_id   = $case_studies_page_info->ID;
					$rt_case_studies_banner = get_post_meta( $case_studies_page_id, 'bannercheck', true );
				}
			} elseif ( class_exists( 'woocommerce' ) && ( is_shop() || is_singular( 'product' ) || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) )
			) {
				$shop_page_info = get_page_by_path( 'shop', OBJECT, 'page' );
				if ( $shop_page_info ) {
					$shop_page_id   = $shop_page_info->ID;
					$rt_shop_banner = get_post_meta( $shop_page_id, 'bannercheck', true );
				}
			} elseif ( is_home() || is_search() || is_category() || is_archive() || is_tag() || is_author() || is_singular( 'post' ) || is_attachment() ) {
				$posts_page_id      = get_option( 'page_for_posts' );
				$rt_posts_page_bann = get_post_meta( $posts_page_id, 'bannercheck', true );
			}

			$rt_bannercheck = get_post_meta( get_the_id(), 'bannercheck', true );
			?>

			<?php // CALL BANNER FILES. ?>
			<?php
			if ( class_exists( 'Redux' ) ) {
				if (
						in_array( $rt_bannercheck, array( 'bannerbreadcumbs', 'banneronly', 'breadcumbsonly', 'nobannerbreadcumbs' ), true ) ||
						in_array( $rt_team_bannercheck, array( 'bannerbreadcumbs', 'banneronly', 'breadcumbsonly', 'nobannerbreadcumbs' ), true ) ||
						in_array( $rt_portfolio_bannercheck, array( 'bannerbreadcumbs', 'banneronly', 'breadcumbsonly', 'nobannerbreadcumbs' ), true ) ||
						in_array( $rt_case_studies_banner, array( 'bannerbreadcumbs', 'banneronly', 'breadcumbsonly', 'nobannerbreadcumbs' ), true ) ||
						in_array( $rt_shop_banner, array( 'bannerbreadcumbs', 'banneronly', 'breadcumbsonly', 'nobannerbreadcumbs' ), true ) ||
						in_array( $rt_posts_page_bann, array( 'bannerbreadcumbs', 'banneronly', 'breadcumbsonly', 'nobannerbreadcumbs' ), true )
					) {
						require get_parent_theme_file_path( '/inc/header/banner.php' );
				} elseif ( get_post_type( get_the_ID() ) == 'elementor_library' ) {

				} else {
					require get_parent_theme_file_path( '/inc/header/theme-banner.php' );
				}
			} elseif ( is_404() ) {
			} else {
				require get_parent_theme_file_path( '/inc/header/banner-default.php' );
			}
			?>
		<!-- #page -->
		<div id="page" class="site">
			<!-- #content -->
			<div id="content" class="site-content">
