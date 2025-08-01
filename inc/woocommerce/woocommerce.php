<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Skinetic
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function skinetic_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'skinetic_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function skinetic_woocommerce_scripts() {
	wp_enqueue_style( 'skinetic-woocommerce-style', get_template_directory_uri() . '/css/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'skinetic-woocommerce-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'skinetic_woocommerce_scripts' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function skinetic_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'skinetic_woocommerce_active_body_class' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function skinetic_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'skinetic_woocommerce_thumbnail_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function skinetic_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'skinetic_woocommerce_related_products_args' );

/**
 * Remove the breadcrumbs 
 */
add_action( 'init', 'skinetic_wc_breadcrumbs' );
function skinetic_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'skinetic_woocommerce_breadcrumb', 'woocommerce_breadcrumb' );
}

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'skinetic_woocommerce_breadcrumbs' );
function skinetic_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '',
            'wrap_before' => '<ul id="breadcrumbs" class="breadcrumbs" itemprop="breadcrumb">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'skinetic' ),
        );
}

/**
 * Remove the product link 
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'skinetic_change_products_title', 10 );
function skinetic_change_products_title() {
    echo '<h2 class="woocommerce-loop-product__title"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h2>';
}

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'skinetic_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function skinetic_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area <?php skinetic_shop_content_columns(); ?>">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'skinetic_woocommerce_wrapper_before' );

if ( ! function_exists( 'skinetic_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function skinetic_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'skinetic_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'skinetic_woocommerce_header_cart' ) ) {
			skinetic_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'skinetic_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function skinetic_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		skinetic_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'skinetic_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'skinetic_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function skinetic_woocommerce_cart_link() {
		?>
		<a class="cart-contents xp-minicart" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'skinetic' ); ?>">
			<i class="xp-webicon-business"></i>
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'skinetic' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

//Get layout shop page.
if ( ! function_exists( 'skinetic_get_shop_layout' ) ) :
	function skinetic_get_shop_layout() {
		// Get layout.
		if( is_product() ){
			$page_layout = skinetic_get_option( 'single_shop_layout' );
		}else{
			$page_layout = skinetic_get_option( 'shop_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'skinetic_shop_content_columns' ) ) :
	function skinetic_shop_content_columns() {

		$shop_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === skinetic_get_shop_layout() && is_active_sidebar( 'shop-sidebar' ) ) {
			$shop_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === skinetic_get_shop_layout() && is_active_sidebar( 'shop-sidebar' ) ) {
			$shop_content_width[] = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right';
		}else{
			$shop_content_width[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
		}

		// return the $classes array
    	echo implode( ' ', $shop_content_width );
	}
endif;

/**
 * Register widget area for shop page.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function skinetic_woocommerce_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'skinetic' ),
        'id'            => 'shop-sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ) );
}
add_action( 'widgets_init', 'skinetic_woocommerce_widgets_init' );


/* Customizer Shop */
function skinetic_shop_customize_settings() {
	/**
	 * Customizer configuration
	 */

	$settings = array(
		'theme' => 'skinetic',
	);

	$panels = array();

	$sections = array(		
        'single_product'           => array(
			'title'       => esc_html__( 'Single Product', 'skinetic' ),
			'description' => '',
			'priority'    => 16,
			'capability'  => 'edit_theme_options',
			'panel'       => 'woocommerce',
		),
	);

	$fields = array(
		// Shop Page
		'shop_layout'           => array(
			'type'        => 'radio-image',
			'label'       => esc_html__( 'Shop Layout', 'skinetic' ),
			'section'     => 'woocommerce_product_catalog',
			'default'     => 'content-sidebar',
			'priority'    => 7,
			'description' => esc_html__( 'Select default sidebar for the shop page.', 'skinetic' ),
			'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
		),		

        // Single Product Page
        'single_shop_layout'           => array(
            'type'        => 'radio-image',
            'label'       => esc_html__( 'Single Product Layout', 'skinetic' ),
            'section'     => 'single_product',
            'default'     => 'content-sidebar',
            'priority'    => 1,
            'choices'     => array(
				'content-sidebar' 	=> get_template_directory_uri() . '/inc/backend/images/right.png',
				'sidebar-content' 	=> get_template_directory_uri() . '/inc/backend/images/left.png',
				'full-content' 		=> get_template_directory_uri() . '/inc/backend/images/full.png',
			)
        ),
        'page_title_product'    => array(
            'type'     => 'text',
            'label'    => esc_html__( 'Title Page Header', 'skinetic' ),
            'section'  => 'single_product',
            'default'  => 'Shop Single',
            'priority' => 1,
        ),
	);

	$settings['panels']   = apply_filters( 'skinetic_customize_panels', $panels );
	$settings['sections'] = apply_filters( 'skinetic_customize_sections', $sections );
	$settings['fields']   = apply_filters( 'skinetic_customize_fields', $fields );

	return $settings;
}

$skinetic_customize = new Skinetic_Customize( skinetic_shop_customize_settings() );