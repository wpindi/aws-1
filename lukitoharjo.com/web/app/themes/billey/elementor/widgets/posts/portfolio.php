<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Portfolio extends Posts_Base {

	public function get_name() {
		return 'tm-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-posts-grid';
	}

	public function get_keywords() {
		return [ 'portfolio', 'project', 'gallery' ];
	}

	protected function get_post_type() {
		return 'portfolio';
	}

	protected function get_post_category() {
		return 'portfolio_category';
	}

	public function get_script_depends() {
		return [
			'billey-grid-query',
			'billey-widget-grid-post',
		];
	}

	protected function _register_controls() {
		$this->add_layout_section();

		$this->add_grid_section();

		$this->add_filter_section();

		$this->add_pagination_section();

		$this->add_box_style_section();

		$this->add_thumbnail_style_section();

		$this->add_overlay_style_section();

		$this->add_caption_style_section();

		$this->add_filter_style_section();

		$this->add_pagination_style_section();

		parent::_register_controls();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'billey' ),
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'grid'    => esc_html__( 'Grid', 'billey' ),
				'masonry' => esc_html__( 'Masonry', 'billey' ),
				'metro'   => esc_html__( 'Metro', 'billey' ),
			],
			'default' => 'grid',
		] );

		$this->add_responsive_control( 'zigzag_height', [
			'label'     => esc_html__( 'Zigzag Height', 'billey' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'condition' => [
				'layout' => 'masonry',
			],
		] );

		$this->add_control( 'zigzag_reversed', [
			'label'     => esc_html__( 'Zigzag Reversed?', 'billey' ),
			'type'      => Controls_Manager::SWITCHER,
			'condition' => [
				'layout' => 'masonry',
			],
		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'billey' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'billey' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'billey' ),
			],
			'default'      => '',
			'prefix_class' => 'billey-animation-',
		] );

		$this->add_control( 'overlay_style', [
			'label'   => esc_html__( 'Overlay', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''              => esc_html__( 'None', 'billey' ),
				'faded'         => esc_html__( 'Faded 01', 'billey' ),
				'faded-02'      => esc_html__( 'Faded 02', 'billey' ),
				'faded-04'      => esc_html__( 'Faded 04', 'billey' ),
				'colored-faded' => esc_html__( 'Colored Faded', 'billey' ),
				'movement'      => esc_html__( 'Movement', 'billey' ),
				'flat'          => esc_html__( 'Flat', 'billey' ),
				'float'         => esc_html__( 'Float', 'billey' ),
				'huge'          => esc_html__( 'Huge', 'billey' ),
			],
			'default' => '',
		] );

		$this->add_control( 'overlay_colored_faded_info', [
			'type'            => Controls_Manager::RAW_HTML,
			'raw'             => esc_html__( 'To choose overlay color & skin for each post item then please edit them & go to Page Options box & select Portfolio tab.', 'billey' ),
			'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			'condition'       => [
				'overlay_style' => 'colored-faded',
			],
		] );

		$this->add_caption_popover();

		$this->add_control( 'metro_image_size_width', [
			'label'     => esc_html__( 'Image Size', 'billey' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'default'   => 480,
			'condition' => [
				'layout' => 'metro',
			],
		] );

		$this->add_control( 'metro_image_ratio', [
			'label'     => esc_html__( 'Image Ratio', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 2,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'default'   => [
				'size' => 1,
			],
			'condition' => [
				'layout' => 'metro',
			],
		] );

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
			'condition'    => [
				'layout!' => 'metro',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'layout!'                 => 'metro',
				'thumbnail_default_size!' => '1',
			],
		] );

		$this->end_controls_section();
	}

	private function add_caption_popover() {
		$this->add_control( 'show_caption', [
			'label'        => esc_html__( 'Caption', 'billey' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => esc_html__( 'Default', 'billey' ),
			'label_on'     => esc_html__( 'Custom', 'billey' ),
			'return_value' => 'yes',
		] );

		$this->start_popover();

		$this->add_control( 'caption_style', [
			'label'   => esc_html__( 'Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01' => esc_html__( 'Style 01', 'billey' ),
				'02' => esc_html__( 'Style 02', 'billey' ),
			],
			'default' => '01',
		] );

		$this->add_control( 'show_caption_category', [
			'label'     => esc_html__( 'Category', 'billey' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => esc_html__( 'Show', 'billey' ),
			'label_off' => esc_html__( 'Hide', 'billey' ),
			'default'   => 'yes',
			'separator' => 'before',
		] );

		$this->add_control( 'show_caption_excerpt', [
			'label'     => esc_html__( 'Excerpt', 'billey' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => esc_html__( 'Show', 'billey' ),
			'label_off' => esc_html__( 'Hide', 'billey' ),
			'separator' => 'before',
		] );

		$this->add_control( 'excerpt_length', [
			'label'     => esc_html__( 'Excerpt Length', 'billey' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 10,
			'condition' => [
				'show_caption_excerpt' => 'yes',
			],
		] );

		$this->end_popover();
	}

	private function add_grid_section() {
		$this->start_controls_section( 'grid_options_section', [
			'label' => esc_html__( 'Grid Options', 'billey' ),
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'billey' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
		] );

		$this->add_responsive_control( 'grid_gutter', [
			'label'   => esc_html__( 'Gutter', 'billey' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => 0,
			'max'     => 200,
			'step'    => 1,
			'default' => 30,
		] );

		$metro_layout_repeater = new Repeater();

		$metro_layout_repeater->add_control( 'size', [
			'label'   => esc_html__( 'Item Size', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '1:1',
			'options' => Widget_Utils::get_grid_metro_size(),
		] );

		$this->add_control( 'grid_metro_layout', [
			'label'       => esc_html__( 'Metro Layout', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $metro_layout_repeater->get_controls(),
			'default'     => [
				[ 'size' => '2:2' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '2:2' ],
				[ 'size' => '1:1' ],
			],
			'title_field' => '{{{ size }}}',
			'condition'   => [
				'layout' => 'metro',
			],
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'box_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .billey-box' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->start_controls_tabs( 'box_style_tabs' );

		$this->start_controls_tab( 'box_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box_background',
			'selector' => '{{WRAPPER}} .billey-box',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_box_shadow',
			'selector' => '{{WRAPPER}} .billey-box',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'box_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box_hover_background',
			'selector' => '{{WRAPPER}} .billey-box:hover',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'box_hover_box_shadow',
			'selector' => '{{WRAPPER}} .billey-box:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_thumbnail_style_section() {
		$this->start_controls_section( 'thumbnail_style_section', [
			'label' => esc_html__( 'Thumbnail', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'thumbnail_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .billey-image, {{WRAPPER}} .billey-image img' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'thumbnail_effects_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'thumbnail_box_shadow',
			'selector' => '{{WRAPPER}} .billey-image',
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters',
			'selector' => '{{WRAPPER}} .billey-image img',
		] );

		$this->add_control( 'thumbnail_opacity', [
			'label'     => esc_html__( 'Opacity', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .billey-image img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'thumbnail_effects_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'thumbnail_box_shadow_hover',
			'selector' => '{{WRAPPER}} .billey-box:hover .billey-image',
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'css_filters_hover',
			'selector' => '{{WRAPPER}} .billey-box:hover .billey-image img',
		] );

		$this->add_control( 'thumbnail_opacity_hover', [
			'label'     => esc_html__( 'Opacity', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .billey-box:hover .billey-image img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_caption_style_section() {
		$this->start_controls_section( 'caption_style_section', [
			'label'     => esc_html__( 'Caption', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'show_caption' => 'yes',
			],
		] );

		$this->add_responsive_control( 'caption_text_align', [
			'label'     => esc_html__( 'Alignment', 'billey' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .post-info' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'caption_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .post-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'caption_title_heading', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'post_title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .post-info .post-title',
		] );

		$this->start_controls_tabs( 'caption_title_tabs' );

		$this->start_controls_tab( 'caption_title_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'post_title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-title' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'caption_title_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'post_title_hover_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-title:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'caption_category_heading', [
			'label'     => esc_html__( 'Category', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'post_category_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .post-info .post-categories',
		] );

		$this->start_controls_tabs( 'caption_category_tabs' );

		$this->start_controls_tab( 'caption_category_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'post_category_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-categories' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'caption_category_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'post_category_hover_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-categories a:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_overlay_style_section() {
		$this->start_controls_section( 'overlay_style_section', [
			'label'     => esc_html__( 'Overlay', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'overlay_style!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'overlay_background',
			'selector' => '{{WRAPPER}} .post-overlay',
		] );

		$this->add_control( 'overlay_opacity', [
			'label'     => esc_html__( 'Opacity', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .post-wrapper:hover .post-overlay' => 'opacity: {{SIZE}};',
			],
		] );

		$this->add_responsive_control( 'overlay_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .post-overlay-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'overlay_title_heading', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'post_overlay_title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .portfolio-overlay-title',
		] );

		$this->add_control( 'post_overlay_title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .portfolio-overlay-title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'overlay_category_heading', [
			'label'     => esc_html__( 'Category', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'overlay_category_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .portfolio-overlay-categories',
		] );

		$this->add_control( 'overlay_category_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .portfolio-overlay-categories' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->query_posts();
		/**
		 * @var $query \WP_Query
		 */
		$query     = $this->get_query();
		$post_type = $this->get_post_type();

		$this->add_render_attribute( 'wrapper', 'class', [
			'billey-grid-wrapper tm-portfolio',
			'style-' . $settings['layout'],
		] );

		if ( 'metro' === $settings['layout'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'billey-grid-metro' );
		}

		if ( $this->is_grid() ) {
			$grid_options = $this->get_grid_options( $settings );

			$this->add_render_attribute( 'wrapper', 'data-grid', wp_json_encode( $grid_options ) );
		}

		if ( 'current_query' === $settings['query_source'] ) {
			$this->add_render_attribute( 'wrapper', 'data-query-main', '1' );
		}

		if ( ! empty( $settings['pagination_type'] ) && $query->found_posts > $settings['query_number'] ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination', $settings['pagination_type'] );
		}

		if ( ! empty( $settings['pagination_custom_button_id'] ) ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination-custom-button-id', $settings['pagination_custom_button_id'] );
		}

		if ( ! empty( $settings['filter_style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'filter-style-' . $settings['filter_style'] );
		}

		if ( ! empty( $settings['overlay_style'] ) ) {
			if ( in_array( $settings['overlay_style'], array( 'faded', 'faded-02', 'colored-faded' ), true ) ) {
				$this->add_render_attribute( 'wrapper', 'class', 'portfolio-overlay-group-01' );
			}

			$this->add_render_attribute( 'wrapper', 'class', 'portfolio-overlay-' . $settings['overlay_style'] );
		}

		if ( ! empty( $settings['caption_style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'portfolio-caption-style-' . $settings['caption_style'] );
		}
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $query->have_posts() ) : ?>

				<?php
				$billey_grid_query['source']        = $settings['query_source'];
				$billey_grid_query['action']        = "{$post_type}_infinite_load";
				$billey_grid_query['max_num_pages'] = $query->max_num_pages;
				$billey_grid_query['found_posts']   = $query->found_posts;
				$billey_grid_query['count']         = $query->post_count;
				$billey_grid_query['query_vars']    = $this->get_query_args();
				$billey_grid_query['settings']      = $settings;
				$billey_grid_query                  = htmlspecialchars( wp_json_encode( $billey_grid_query ) );
				?>
				<input type="hidden" class="billey-query-input" <?php echo 'value="' . $billey_grid_query . '"'; ?>/>

				<?php $this->print_filter( $query->found_posts ); ?>

				<div class="billey-grid">
					<?php if ( $this->is_grid() ) : ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>

					<?php
					set_query_var( 'billey_query', $query );
					set_query_var( 'settings', $settings );

					get_template_part( 'loop/widgets/portfolio/style', $settings['layout'] );
					?>
				</div>

				<?php $this->print_pagination( $query, $settings ); ?>

				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
		<?php
	}
}
