<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initial OneClick import for this theme
 */
if ( ! class_exists( 'Billey_Import' ) ) {
	class Billey_Import {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );
			add_filter( 'insight_core_import_generate_thumb', array( $this, 'generate_thumbnail' ) );
		}

		public function import_demos() {
			return array(
				'01' => array(    // Done.
					'screenshot' => BILLEY_THEME_URI . '/screenshot.jpg',
					'name'       => BILLEY_THEME_NAME,
					'url'        => 'https://api.thememove.com/import/billey/billey-insightcore01-1.0.1.zip',
				),
			);
		}

		/**
		 * Generate thumbnail while importing
		 */
		function generate_thumbnail() {
			return false;
		}
	}

	Billey_Import::instance()->initialize();
}
