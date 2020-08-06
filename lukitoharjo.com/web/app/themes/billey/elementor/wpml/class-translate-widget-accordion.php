<?php

namespace Billey_Elementor;

use WPML_Elementor_Module_With_Items;

defined( 'ABSPATH' ) || exit;

class Translate_Widget_Accordion extends WPML_Elementor_Module_With_Items {

	/**
	 * Repeater field id
	 *
	 * @return string
	 */
	public function get_items_field() {
		return 'items';
	}

	/**
	 * Repeater items field id
	 *
	 * @return array List inner fields translatable.
	 */
	public function get_fields() {
		return [
			'title',
			'content',
		];
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch ( $field ) {
			case 'title':
				return esc_html__( 'Accordion: Title', 'billey' );

			case 'content':
				return esc_html__( 'Accordion: Content', 'billey' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch ( $field ) {
			case 'title':
				return 'LINE';

			case 'content':
				return 'AREA';

			default:
				return '';
		}
	}
}
