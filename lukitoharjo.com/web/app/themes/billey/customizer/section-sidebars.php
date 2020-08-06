<?php
$section             = 'sidebars';
$priority            = 1;
$prefix              = 'sidebars_';
$sidebar_positions   = Billey_Helper::get_list_sidebar_positions();
$registered_sidebars = Billey_Helper::get_registered_sidebars();

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => sprintf( '<div class="desc">
			<strong class="insight-label insight-label-info">%s</strong>
			<p>%s</p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'billey' ), esc_html__( 'Sidebar 2 can only be used if sidebar 1 is selected.', 'billey' ), esc_html__( 'Sidebar position option will control the position of sidebar 1. If sidebar 2 is selected, it will display on the opposite side.', 'billey' ) ),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'General Settings', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'one_sidebar_breakpoint',
	'label'       => esc_html__( 'One Sidebar Breakpoint', 'billey' ),
	'description' => esc_html__( 'Controls the breakpoint when has only one sidebar to make the sidebar 100% width.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 992,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'both_sidebar_breakpoint',
	'label'       => esc_html__( 'Both Sidebars Breakpoint', 'billey' ),
	'description' => esc_html__( 'Controls the breakpoint when has both sidebars to make sidebars 100% width.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'sidebars_below_content_mobile',
	'label'       => esc_html__( 'Sidebars Below Content', 'billey' ),
	'description' => esc_html__( 'Move sidebars display after main content on smaller screens.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'No', 'billey' ),
		'1' => esc_html__( 'Yes', 'billey' ),
	),
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Sidebar Layouts', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'single_sidebar_width',
	'label'       => esc_html__( 'Single Sidebar Width', 'billey' ),
	'description' => esc_html__( 'Controls the width of the sidebar when only one sidebar is present. Input value as % unit. For e.g: 33.33333', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '33.333333',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'single_sidebar_offset',
	'label'       => esc_html__( 'Single Sidebar Offset', 'billey' ),
	'description' => esc_html__( 'Controls the offset of the sidebar when only one sidebar is present. Enter value including any valid CSS unit. For e.g: 70px.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '20px',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Dual Sidebar Layouts', 'billey' ) . '</div>',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'dual_sidebar_width',
	'label'       => esc_html__( 'Dual Sidebar Width', 'billey' ),
	'description' => esc_html__( 'Controls the width of sidebars when dual sidebars are present. Enter value including any valid CSS unit. For e.g: 33.33333.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '25',
) );

Billey_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'dual_sidebar_offset',
	'label'       => esc_html__( 'Dual Sidebar Offset', 'billey' ),
	'description' => esc_html__( 'Controls the offset of sidebars when dual sidebars are present. Enter value including any valid CSS unit. For e.g: 70px.', 'billey' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
) );
