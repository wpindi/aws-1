<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Portfolio_Carousel extends Posts_Carousel_Base {

	public function get_name() {
		return 'tm-portfolio-carousel';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Carousel', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-posts-carousel';
	}

	public function get_keywords() {
		return [ 'portfolio', 'carousel' ];
	}

	protected function get_post_type() {
		return 'portfolio';
	}

	protected function _register_controls() {
		$this->add_layout_section();

		$this->add_thumbnail_style_section();

		$this->add_caption_style_section();

		parent::_register_controls();

		$this->update_controls();
	}

	private function update_controls() {
		$this->update_responsive_control( 'swiper_items', [
			'default' => '4',
		] );

		$this->update_responsive_control( 'swiper_gutter', [
			'default'        => 60,
			'tablet_default' => 30,
		] );

		$this->update_control( 'swiper_centered', [
			'default' => 'yes',
		] );
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'billey' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => array(
				'01' => esc_html__( 'Style 01', 'billey' ),
				'02' => esc_html__( 'Style 02', 'billey' ),
				'03' => esc_html__( 'Style 03', 'billey' ),
			),
			'default'      => '01',
			'prefix_class' => 'billey-portfolio-carousel-',
			'render_type'  => 'template',
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

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
		] );

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'thumbnail_default_size!' => '1',
				],
			]
		);

		$this->end_controls_section();
	}

	private function add_thumbnail_style_section() {
		$this->start_controls_section( 'thumbnail_style_section', [
			'label' => esc_html__( 'Thumbnail', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'thumbnail_height', [
			'label'          => esc_html__( 'Height', 'billey' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%', 'vw' ],
			'range'          => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
				'vw' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .post-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
			],
			'render_type'    => 'template',
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'thumbnail_css_filters',
			'selector' => '{{WRAPPER}} .post-thumbnail img',
		] );

		$this->end_controls_section();
	}

	private function add_caption_style_section() {
		$this->start_controls_section( 'caption_style_section', [
			'label' => esc_html__( 'Caption', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'caption_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .post-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'caption_text_align', [
			'label'     => esc_html__( 'Text Align', 'billey' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}} .post-info' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'title_style_heading', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .post-info .post-title',
		] );

		$this->start_controls_tabs( 'title_color_tabs' );

		$this->start_controls_tab( 'title_color_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-title' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_color_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-title:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'category_style_heading', [
			'label'     => esc_html__( 'Category', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'category_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .post-info .post-categories',
		] );

		$this->start_controls_tabs( 'category_color_tabs' );

		$this->start_controls_tab( 'category_color_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'category_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .post-info .post-categories' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'category_color_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'category_hover_color', [
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

	protected function print_slide( array $settings ) {
		?>
		<div class="swiper-slide">
			<div class="post-wrapper billey-box">

				<?php if ( '02' === $settings['style'] ) : ?>
					<a href="<?php \Billey_Portfolio::instance()->the_permalink(); ?>"
					   class="post-permalink link-secret">
						<div class="post-thumbnail billey-image">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php $size = \Billey_Image::elementor_parse_image_size( $settings, '480x480' ); ?>
								<?php \Billey_Image::the_post_thumbnail( array( 'size' => $size ) ); ?>
							<?php } else { ?>
								<?php \Billey_Templates::image_placeholder( 480, 480 ); ?>
							<?php } ?>

							<div class="post-overlay"></div>

							<div class="post-info">
								<h3 class="post-title"><?php the_title(); ?></h3>

								<div class="portfolio-excerpt">
									<?php \Billey_Templates::excerpt( array(
										'limit' => 26,
										'type'  => 'word',
									) ); ?>
								</div>

								<div class="portfolio-read-more-icon"><span class="fas fa-arrow-right"></span></div>
							</div>
						</div>
					</a>
				<?php elseif ( '03' === $settings['style'] ) : ?>
					<div class="post-thumbnail billey-image">
						<a href="<?php \Billey_Portfolio::instance()->the_permalink(); ?>"
						   class="post-permalink link-secret">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php $size = \Billey_Image::elementor_parse_image_size( $settings, '480x480' ); ?>
								<?php \Billey_Image::the_post_thumbnail( array( 'size' => $size ) ); ?>
							<?php } else { ?>
								<?php \Billey_Templates::image_placeholder( 480, 480 ); ?>
							<?php } ?>
						</a>
					</div>

					<div class="post-info">
						<h3 class="post-title">
							<a href="<?php \Billey_Portfolio::instance()->the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
					</div>
				<?php else: ?>
					<div class="post-thumbnail billey-image">
						<a href="<?php \Billey_Portfolio::instance()->the_permalink(); ?>"
						   class="post-permalink link-secret">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php $size = \Billey_Image::elementor_parse_image_size( $settings, '480x480' ); ?>
								<?php \Billey_Image::the_post_thumbnail( array( 'size' => $size ) ); ?>
							<?php } else { ?>
								<?php \Billey_Templates::image_placeholder( 480, 480 ); ?>
							<?php } ?>
						</a>
					</div>

					<div class="post-info">
						<h3 class="post-title">
							<a href="<?php \Billey_Portfolio::instance()->the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<?php \Billey_Portfolio::instance()->the_categories(); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}
}
