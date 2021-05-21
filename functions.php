<?php

/**
 * ecom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ecom
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('ecom_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ecom_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ecom, use a find and replace
		 * to change 'ecom' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('ecom', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'ecom'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'ecom_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'ecom_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ecom_content_width()
{
	$GLOBALS['content_width'] = apply_filters('ecom_content_width', 640);
}
add_action('after_setup_theme', 'ecom_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ecom_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'ecom'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'ecom'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'ecom_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function ecom_scripts()
{
	wp_enqueue_style('ecom-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('ecom-main', get_template_directory_uri() . '/css/main.css');
	wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css');
	wp_style_add_data('ecom-style', 'rtl', 'replace');

	wp_enqueue_script('ecom-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('ecom-bootstrap-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'));
	wp_enqueue_script('ecom-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('ecom-script', get_template_directory_uri() . '/js/script.js', array('jquery'), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'ecom_scripts');

/**
 * Custom Fonts
 */
function t_ecom_enqueue_custom_fonts()
{

	wp_register_style('t_ecom_source_sans_pro', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,600&display=swap');
	wp_register_style('t_ecom_nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');
	wp_enqueue_style('t_ecom_source_sans_pro');
	wp_enqueue_style('t_ecom_nunito');
}
add_action('wp_enqueue_scripts', 't_ecom_enqueue_custom_fonts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
	global $woocommerce;

	ob_start();

?>
<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>"
    title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>
    - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}


/**
 * Footer Widget One
 */

function t_ecom_footer_widget_one()
{
	$args = array(
		'id'			=>	'footer-widget-col-one',
		'name'			=>	__('Footer Column One', 'ecom'),
		'description'	=>	__('Column One', 'ecom'),
		'before_title'	=>	'<h3 class="title">',
		'after_title'	=>	'</h3>',
		'before_widget'	=>	'<div id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</div>'
	);

	register_sidebar($args);
}

add_action('widgets_init', 't_ecom_footer_widget_one');

/**
 * Footer Widget Two
 */
function t_ecom_footer_widget_two()
{
	$args = array(
		'id'			=>	'footer-widget-col-two',
		'name'			=>	__('Footer Column Two', 'ecom'),
		'description'	=>	__('Column Two', 'ecom'),
		'before_title'	=>	'<h3 class="title">',
		'after_title'	=>	'</h3>',
		'before_widget'	=>	'<div id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</div>'
	);

	register_sidebar($args);
}

add_action('widgets_init', 't_ecom_footer_widget_two');


/**
 * Footer Widget Three
 */
function t_ecom_footer_widget_three()
{
	$args = array(
		'id'			=>	'footer-widget-col-three',
		'name'			=>	__('Footer Column Three', 'ecom'),
		'description'	=>	__('Column Three', 'ecom'),
		'before_title'	=>	'<h3 class="title">',
		'after_title'	=>	'</h3>',
		'before_widget'	=>	'<div id="%1$s" class="widget %2$s">',
		'after_widget'	=>	'</div>'
	);

	register_sidebar($args);
}

add_action('widgets_init', 't_ecom_footer_widget_three');


/**
 * Woocommerce
 */

add_theme_support('woocommerce');