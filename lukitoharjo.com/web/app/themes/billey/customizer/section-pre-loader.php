<?php
$section  = 'pre_loader';
$priority = 1;
$prefix   = 'pre_loader_';

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'enable',
	'label'    => esc_html__( 'Enable Preloader', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'style',
	'label'    => esc_html__( 'Style', 'billey' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'circle',
	'choices'  => Billey_Helper::get_preloader_list(),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'background_color',
	'label'     => esc_html__( 'Background Color', 'billey' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#fff',
	'output'    => array(
		array(
			'element'  => '.page-loading',
			'property' => 'background-color',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'shape_color',
	'label'           => esc_html__( 'Shape Color', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'default'         => Billey::PRIMARY_COLOR,
	'output'          => array(
		array(
			'element'  => '.page-loading .sk-wrap',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '!=',
			'value'    => 'gif-image',
		),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'            => 'image',
	'settings'        => 'pre_loader_image',
	'label'           => esc_html__( 'Gif Image', 'billey' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => BILLEY_THEME_IMAGE_URI . '/main-preloader.gif',
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '==',
			'value'    => 'gif-image',
		),
	),
) );
