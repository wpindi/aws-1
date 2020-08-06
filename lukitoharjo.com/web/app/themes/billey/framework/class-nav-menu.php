<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Nav_Menu' ) ) {
	class Billey_Nav_Menu {

		function __construct() {
			add_action( 'wp_update_nav_menu', array( $this, 'clear_transient_nav_menus' ), 10 );
			add_action( 'wp_delete_nav_menu', array( $this, 'clear_transient_nav_menus' ), 10 );
		}

		public function clear_transient_nav_menus() {
			delete_transient( 'billey-nav-menus' );
		}

		/**
		 * @return array|int|WP_Error
		 */
		public static function get_all_menus() {
			$results = get_transient( 'billey-nav-menus' );

			// If the photos is cached, use them & early exit.
			if ( false !== $results ) {
				return $results;
			}

			$args = array(
				'taxonomy'   => 'nav_menu',
				'hide_empty' => false,
			);

			$menus   = get_terms( $args );
			$results = array();

			foreach ( $menus as $key => $menu ) {
				$results[ $menu->slug ] = $menu->name;
			}
			$results[''] = esc_html__( 'Default Menu', 'billey' );

			set_transient( 'billey-nav-menus', $results, HOUR_IN_SECONDS * 2 );

			return $results;
		}
	}

	new Billey_Nav_Menu();
}
