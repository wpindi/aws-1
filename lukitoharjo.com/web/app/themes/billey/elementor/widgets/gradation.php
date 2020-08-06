<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Gradation extends Base {

	public function get_name() {
		return 'tm-gradation';
	}

	public function get_title() {
		return esc_html__( 'Gradation', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-navigation-horizontal';
	}

	public function get_keywords() {
		return [ 'gradation', 'step' ];
	}

	protected function _register_controls() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'billey' ),
		] );

		$this->add_control( 'layout', [
			'label'        => esc_html__( 'Layout', 'billey' ),
			'label_block'  => false,
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'block',
			'options'      => [
				'block'  => [
					'title' => esc_html__( 'Default', 'billey' ),
					'icon'  => 'eicon-editor-list-ul',
				],
				'inline' => [
					'title' => esc_html__( 'Inline', 'billey' ),
					'icon'  => 'eicon-ellipsis-h',
				],
			],
			'prefix_class' => 'billey-gradation-layout-',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'billey' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'description', [
			'label' => esc_html__( 'Description', 'billey' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'       => 'Copy Writing',
					'description' => 'Lorem Ipsum aenean commo dolig siove. Proin qual de suis erestopius. Liqueenean sollicituin orem quis bibendum auct ornis.Lorem Ipsum aenean commo dolig siove.',
				],
				[
					'title'       => 'Developing',
					'description' => 'Lorem Ipsum aenean commo dolig siove. Proin qual de suis erestopius. Liqueenean sollicituin orem quis bibendum auct ornis.Lorem Ipsum aenean commo dolig siove.',
				],
				[
					'title'       => 'Management',
					'description' => 'Lorem Ipsum aenean commo dolig siove. Proin qual de suis erestopius. Liqueenean sollicituin orem quis bibendum auct ornis.Lorem Ipsum aenean commo dolig siove.',
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();

		$this->add_styling_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Styling', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Text Align', 'billey' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .item' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'title_heading', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'description_heading', [
			'label'     => esc_html__( 'Description', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .description',
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'number_heading', [
			'label'     => esc_html__( 'Number', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'number_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .count' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'special_line_heading', [
			'label'     => esc_html__( 'Line', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'special_line_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .line' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'billey-gradation' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php
			$loop_count = 0;
			if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
				foreach ( $settings['items'] as $key => $item ) {
					$loop_count++;

					$numbered = str_pad( $loop_count, 2, '0', STR_PAD_LEFT );
					?>
					<div class="item">

						<div class="count-wrap">
							<div class="count"><?php echo esc_html( $numbered ); ?></div>
							<div class="line"></div>
						</div>

						<div class="content-wrap">
							<?php if ( isset( $item['title'] ) ) : ?>
								<h5 class="title"><?php echo esc_html( $item['title'] ); ?></h5>
							<?php endif; ?>

							<?php if ( isset( $item['description'] ) ) : ?>
								<div class="description"><?php echo esc_html( $item['description'] ); ?></div>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}
