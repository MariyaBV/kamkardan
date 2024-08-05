<?php
/**
 * kamkardan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kamkardan
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kamkardan_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on kamkardan, use a find and replace
		* to change 'kamkardan' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'kamkardan', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'top-menu' => esc_html__( 'Top Menu', 'kamkardan' ),
			'bottom-menu' => esc_html__( 'Bottom Menu', 'kamkardan' ),
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
			'kamkardan_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'kamkardan_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kamkardan_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kamkardan_content_width', 640 );
}
add_action( 'after_setup_theme', 'kamkardan_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kamkardan_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kamkardan' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kamkardan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kamkardan_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kamkardan_scripts() {
    wp_enqueue_style( 'kamkardan-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'kamkardan-style', 'rtl', 'replace' );

    wp_enqueue_script('kamkardan-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), _S_VERSION, true);

    wp_register_script('kamkardan-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script( 'kamkardan-main' );

    // Локализация скрипта для передачи AJAX URL и других данных
    wp_localize_script('kamkardan-main', 'custom_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));

    wp_enqueue_script( 'kamkardan-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if (is_product()) {
        wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), '3.5.7');
        wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
    }
}
add_action( 'wp_enqueue_scripts', 'kamkardan_scripts' );

function true_jquery_register() {
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false, null, true );
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'init', 'true_jquery_register' );


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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//ф-я вывода корзины в header
function custom_woocommerce_header_cart() {
    ?>
    <div class="header-cart">
        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'your-theme-slug' ); ?>">
			<span class="icon-Property-1Default"></span>
            <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </a>
    </div>
    <?php
}

//стиль к item menu на странице которой находимся
function get_menu_items_with_classes($menu_name) {
    $locations = get_nav_menu_locations();
    $menu_id = isset($locations[$menu_name]) ? $locations[$menu_name] : 0;
    $menu_items = wp_get_nav_menu_items($menu_id);
    
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
    $current_path = trim(parse_url($current_url, PHP_URL_PATH), '/');

    foreach ($menu_items as $menu_item) {
        $menu_path = trim(parse_url($menu_item->url, PHP_URL_PATH), '/');

        if ($menu_item->url === '#catalog') {
            continue;
        }

        if ($menu_path === $current_path) {
            $menu_item->classes[] = 'selected-item-menu';
        }
    }

    return $menu_items;
}

//ф-я запроса обратного звонка
function handle_callback_request() {
    if (isset($_POST['name']) && isset($_POST['phone'])) {
        $name = sanitize_text_field($_POST['name']);
        $phone = sanitize_text_field($_POST['phone']);
        
        // Отправка данных на email
        $to = 'mari.mv2008@gmail.com'; //НУЖНО ЗАМЕНИТЬ НА email клиента
        $subject = 'Запрос на обратный звонок';
        $message = 'Имя: ' . $name . "\nТелефон: " . $phone;
        wp_mail($to, $subject, $message);

        wp_send_json_success('Запрос отправлен');
    } else {
        wp_send_json_error('Заполните все поля');
    }
}

add_action('wp_ajax_callback_request', 'handle_callback_request');
add_action('wp_ajax_nopriv_callback_request', 'handle_callback_request');


function kamkardan_blocks() {
	// check function exists
	if (function_exists('acf_register_block')) {

		$blocks = [
			'slider' => [
				'description' => __('Блок со слайдером', 'kamkardan'),
				'title' => __('Блок со слайдером', 'kamkardan'),
				'keywords' => array('Блок-со-слайдером', 'баннер')
			],
			'product-category' => [
				'description' => __('Блок вывода товаров из 1 категории', 'kamkardan'),
				'title' => __('Блок вывода товаров из 1 категории', 'kamkardan'),
				'keywords' => array('блок-товаров-1-категории', 'баннер')
			],
			'list-with-img' => [
				'description' => __('Список с заголовком и картинками', 'kamkardan'),
				'title' => __('Список с заголовком и картинками', 'kamkardan'),
				'keywords' => array('Список-заголовком-картинками', 'баннер')
			],
			'list-img' => [
				'description' => __('Список с картинкой', 'kamkardan'),
				'title' => __('Список с картинкой', 'kamkardan'),
				'keywords' => array('Список-с-картинкой', 'баннер')
			],
			'images-text' => [
				'description' => __('Блок текст на картинке', 'kamkardan'),
				'title' => __('Блок текст на картинке', 'kamkardan'),
				'keywords' => array('Блок-текст-на-картинке', 'баннер')
			]
		];

		foreach ($blocks as $title => $arr) {
			acf_register_block(
				array(
					'name' => $title,
					'title' => $arr['title'],
					'description' => $arr['description'],
					'render_callback' => 'kamkardan_block',
					'category' => 'formatting',
					'icon' => 'admin-comments',
					'keywords' => $arr['keywords'],
					'mode' => 'edit'
				)
			);
		}

	}
}
add_action('acf/init', 'kamkardan_blocks');
function kamkardan_block($block) {
    $slug = str_replace('acf/', '', $block['name']);
    $template_path = get_theme_file_path("/template-parts/block-{$slug}.php");
    if (file_exists($template_path)) {
        include ($template_path);
    } else {
        echo "Template not found: " . $template_path;
    }
}

