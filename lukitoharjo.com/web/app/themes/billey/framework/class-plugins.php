<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Billey_Register_Plugins' ) ) {
	class Billey_Register_Plugins {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins( $plugins ) {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$new_plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'billey' ),
					'slug'     => 'insight-core',
					'source'   => 'https://www.dropbox.com/s/uj3p9es3k4hfq2x/insight-core-1.7.0.zip?dl=1',
					'version'  => '1.7.0',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Elementor', 'billey' ),
					'slug'     => 'elementor',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Elementor Pro', 'billey' ),
					'slug'     => 'elementor-pro',
					'source'   => 'https://www.dropbox.com/s/cpoyhnjs863ywj6/elementor-pro-2.8.5.zip?dl=1',
					'version'  => '2.8.5',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'Revolution Slider', 'billey' ),
					'slug'    => 'revslider',
					'source'  => 'https://www.dropbox.com/s/t0tfdtxjrd46svs/revslider-6.2.15.zip?dl=1',
					'version' => '6.2.15',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'billey' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'billey' ),
					'slug' => 'woocommerce',
				),
				array(
					'name' => esc_html__( 'WPC Smart Compare for WooCommerce', 'billey' ),
					'slug' => 'woo-smart-compare',
				),
				array(
					'name' => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'billey' ),
					'slug' => 'woo-smart-wishlist',
				),
				array(
					'name' => esc_html__( 'Booking.com Official Search Box', 'billey' ),
					'slug' => 'bookingcom-official-searchbox',
				),
			);

			$plugins = array_merge( $plugins, $new_plugins );

			return $plugins;
		}

	}

	Billey_Register_Plugins::instance()->initialize();
}
