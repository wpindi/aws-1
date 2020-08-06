<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

abstract class Static_Grid extends Grid_Base {

	private $current_item     = null;
	private $current_item_key = null;

	abstract protected function add_repeater_controls( Repeater $repeater );

	abstract protected function get_repeater_defaults();

	abstract protected function print_grid_item();

	protected function _register_controls() {
		$this->start_controls_section( 'items_section', [
			'label' => esc_html__( 'Items', 'billey' ),
		] );

		$repeater = new Repeater();

		$this->add_repeater_controls( $repeater );

		$this->add_control( 'items', [
			'label'     => esc_html__( 'Items', 'billey' ),
			'type'      => Controls_Manager::REPEATER,
			'fields'    => $repeater->get_controls(),
			'default'   => $this->get_repeater_defaults(),
			'separator' => 'after',
		] );

		$this->end_controls_section();

		parent::_register_controls();
	}

	protected function print_grid_items( array $settings ) {
		foreach ( $settings['items'] as $item ) :
			$item_id = $item['_id'];
			$item_key = 'item_' . $item_id;

			$this->set_current_item( $item );
			$this->set_current_item_key( $item_key );

			$this->add_render_attribute( $item_key, [
				'class' => [
					'grid-item',
					'elementor-repeater-item-' . $item_id,
				],
			] );
			?>
			<div <?php $this->print_render_attribute_string( $item_key ); ?>>
				<?php $this->print_grid_item(); ?>
			</div>
		<?php endforeach;
	}

	protected function get_current_item() {
		return $this->current_item;
	}

	protected function get_current_item_key() {
		return $this->current_item_key;
	}

	protected function set_current_item( $item ) {
		$this->current_item = $item;
	}

	protected function set_current_item_key( $key ) {
		$this->current_item_key = $key;
	}
}
