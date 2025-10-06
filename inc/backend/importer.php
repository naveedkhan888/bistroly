<?php
/**
 * Hooks for importer
 *
 * @package Bistroly
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function bistroly_importer() {
	return array(
		array(
			'name'       => 'Main Demo (all layout)',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 2',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer-coffee.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 3',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home3.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer-icecream.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 4',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home4.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer-pizza.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 4',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Home 5',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home5.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer-juice.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 5',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'bistroly_importer', 30 );