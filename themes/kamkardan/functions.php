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
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['type'])) {
        $name = sanitize_text_field($_POST['name']);
        $phone = sanitize_text_field($_POST['phone']);
        $type = sanitize_text_field($_POST['type']);
        $comment = isset($_POST['comment']) ? sanitize_textarea_field($_POST['comment']) : '';

        $to = 'mari.mv2008@gmail.com'; // ЗАМЕНИТЬ!!!!! на email клиента
        
        switch($type) {
            case 'job_application':
                $subject = 'Ответ на вакансию';
                break;
            case 'callback_request':
                $subject = 'Запрос на обратный звонок';
                break;
            case 'repair_request':
                $subject = 'Заявка на ремонт';
                break;
            default:
                $subject = 'Новый запрос';
        }
        
        $message = 'Имя: ' . $name . "\nТелефон: " . $phone;

        if (!empty($comment)) {
            $message .= "\nКомментарий: " . $comment;
        }
        $message .= "\n";

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
			'callback-repair' => [
				'description' => __('Оставить заявку на', 'kamkardan'),
				'title' => __('Оставить заявку на', 'kamkardan'),
				'keywords' => array('Оставить-заявку-на-', 'баннер')
			],
			'images-links' => [
				'description' => __('Блок c картинками-ссылками', 'kamkardan'),
				'title' => __('Блок c картинками-ссылками', 'kamkardan'),
				'keywords' => array('блок-c-картинками-ссылками', 'баннер')
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
				'description' => __('Блок картинки с текстом', 'kamkardan'),
				'title' => __('Блок картинки с текстом', 'kamkardan'),
				'keywords' => array('Блок-картинки-с-текстом', 'баннер')
			],
			'vacancy' => [
				'description' => __('Блок вакансии', 'kamkardan'),
				'title' => __('Блок вакансии', 'kamkardan'),
				'keywords' => array('Блок-вакансии', 'баннер')
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

//начало делаем выбор в админке скидки в % и вывод на карточке товара
add_action( 'woocommerce_product_options_pricing', 'genius_set_percentage_discount' );
function genius_set_percentage_discount() {
   global $product_object;
   woocommerce_wp_select(
      array(
         'id' => '_pc_discount',
         'value' => get_post_meta( $product_object->get_id(), '_pc_discount', true ),
         'label' => 'Discount %',
         'options' => array(
            '0' => '0',
			'5' => '5',
            '10' => '10',
			'15' => '15',
			'20' => '20',
            '25' => '25',
			'30' => '30',
            '50' => '50',
         ),
      )
   );
}
 
add_action( 'save_post_product', 'genius_save_percentage_discount' );
function genius_save_percentage_discount( $product_id ) {
    global $typenow;
    if ( 'product' === $typenow ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( isset( $_POST['_pc_discount'] ) ) {
            update_post_meta( $product_id, '_pc_discount', $_POST['_pc_discount'] );
        }
    }
}
  
add_filter( 'woocommerce_get_price_html', 'genius_alter_price_display', 9999, 2 );
function genius_alter_price_display( $price_html, $product ) {
    if ( is_admin() ) return $price_html;
    if ( '' === $product->get_price() ) return $price_html;
    if ( get_post_meta( $product->get_id(), '_pc_discount', true ) && get_post_meta( $product->get_id(), '_pc_discount', true ) > 0 ) {
        $orig_price = wc_get_price_to_display( $product );
        $price_html = wc_format_sale_price( $orig_price, $orig_price * ( 100 - get_post_meta( $product->get_id(), '_pc_discount', true ) ) / 100 );
    }
    return $price_html;
}
  
add_action( 'woocommerce_before_calculate_totals', 'genius_alter_price_cart', 9999 );
function genius_alter_price_cart( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 ) return;
    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
      if ( get_post_meta( $product->get_id(), '_pc_discount', true ) && get_post_meta( $product->get_id(), '_pc_discount', true ) > 0 ) {
           $price = $product->get_price();
           $cart_item['data']->set_price( $price * ( 100 - get_post_meta( $product->get_id(), '_pc_discount', true ) ) / 100 );
      }
    }
}
// вывод скидки в % на картинке карточки товара
add_action( 'woocommerce_before_shop_loop_item_title', 'genius_display_discount_badge', 10 );
function genius_display_discount_badge() {
    global $product;
    
    $discount = get_post_meta( $product->get_id(), '_pc_discount', true );
    if ( $discount && $discount > 0 ) {
        echo '<span class="discount-badge">-' . esc_html( $discount ) . '%</span>';
    }
}

function genius_display_discount_badge_return() {
    global $product;

    $discount = get_post_meta($product->get_id(), '_pc_discount', true);
    if ($discount && $discount > 0) {
        return '<span class="discount-badge">-' . esc_html($discount) . '%</span>';
    }
    return '';
}
//конец делаем выбор в админке скидки в % и вывод на карточке товара


//начало делаем sidebar с категориями на странице продукта и продуктов
// Кастомный класс Walker для вывода миниатюр в списке категорий
class Walker_Category_Thumbnails extends Walker_Category {
    private $expanded_parents = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='children'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $cat_name = esc_attr( $category->name );
        $cat_name = apply_filters( 'list_cats', $cat_name, $category );

        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
        $image_url = wp_get_attachment_url( $thumbnail_id );
        $link = get_term_link( $category );

        $active = '';
        $expanded = '';
        $my_category = get_queried_object();

        if (is_product_category() && ($my_category->term_id == $category->term_id)) {
            $active = 'selected';
        }

        if (is_product_category() && term_is_ancestor_of($category->term_id, $my_category->term_id, 'product_cat')) {
            $expanded = 'expanded';
        }

        if (is_product()) {
            $product_id = get_the_ID();
            $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids'));

            if (in_array($category->term_id, $product_categories)) {
                $active = 'selected';
            }
        }

        $output .= "\t<li id='cat-item-{$category->term_id}' class='cat-item cat-item-{$category->term_id} $active $expanded'>";
        $output .= "<a class='cat-link' href='" . esc_url( $link ) . "'>";

        $output .= "<img class='cat-image' src='" . esc_url( $image_url ) . "' alt='" . esc_attr( $cat_name ) . "' />";

        $output .= "<span class='cat-name'>" . "$cat_name" . "</span>";
        $output .= "</a>";
        if ( ! empty( $args['show_count'] ) ) {
            $output .= ' (' . number_format_i18n( $category->count ) . ')';
        }
    }

    function end_el( &$output, $category, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}
function add_product_category_sidebar() {
    //if (!is_product()) {
        ?>
        <aside class="product-category-sidebar">
            <?php
            $args = array(
                'show_option_all'    => '',
                'show_option_none'   => __('No categories'),
                'orderby'            => 'name',
                'order'              => 'ASC',
                'style'              => 'list',
                'show_count'         => 0,
                'hide_empty'         => 1,
                'use_desc_for_title' => 0,
                'child_of'           => 0,
                'feed'               => '',
                'feed_type'          => '',
                'feed_image'         => '',
                'exclude'            => '',
                'exclude_tree'       => '',
                'include'            => '',
                'hierarchical'       => true,
                'title_li'           => '',
                'number'             => NULL,
                'echo'               => 0,
                'depth'              => 0,
                'current_category'   => 0,
                'pad_counts'         => 0,
                'taxonomy'           => 'product_cat',
                'walker'             => new Walker_Category_Thumbnails(),
                'hide_title_if_empty' => false,
                'separator'          => '<br />',
            );
            $categories = wp_list_categories($args);
            ?>
            <div id="catalog-sidebar" class="category-list-categories mobile">
                <h3>Карданы</h3>
                <ul class="category-list">
                    <?php echo $categories; ?>
                </ul>
            </div>
        </aside>
        <?php
    //}
}
//конец делаем sidebar с категориями на странице продукта и продуктов


//вывод номера кардана из атрибутов на странице товара и карточке
function custom_woocommerce_attr_num_cardan() {
    if ( is_product() || is_shop() || is_product_category() ) {
        global $product;
        
        // Получаем все атрибуты товара
        $attributes = $product->get_attributes();

        if ( isset( $attributes['pa_cardan-shaft-number'] ) ) {
            $attribute = $attributes['pa_cardan-shaft-number'];

            $terms = wc_get_product_terms( $product->get_id(), 'pa_cardan-shaft-number', array( 'fields' => 'names' ) );

            if ( ! empty( $terms ) ) {
                $value = implode( ', ', $terms );
                echo '<p class="product-attribute-cardan-shaft-number">Номер кардана: <span>' . esc_html( $value ) . '</span></p>';
            }
        }
    }
}
add_action('custom_woocommerce_attr_num_cardan', 'custom_woocommerce_attr_num_cardan');
add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_attr_num_cardan', 15);

//вывод Длины в сжатом положении, мм: на карточке товара
function custom_woocommerce_attr_len_cardan() {
    if ( is_shop() || is_product_category() ) {
        global $product;
        
        // Получаем все атрибуты товара
        $attributes = $product->get_attributes();

        if ( isset( $attributes['pa_length-compressed-position'] ) ) {
            $attribute = $attributes['pa_length-compressed-position'];

            $terms = wc_get_product_terms( $product->get_id(), 'pa_length-compressed-position', array( 'fields' => 'names' ) );

            if ( ! empty( $terms ) ) {
                $value = implode( ', ', $terms );
                echo '<p class="product-attribute-length-compressed-position">Длина в сжатом положении, мм: <span>' . esc_html( $value ) . '</span></p>';
            }
        }
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'custom_woocommerce_attr_len_cardan', 15);

//начало добавляем к поиску поиск по атрибутам
function custom_search_query($query) {
    if ( !is_admin() && $query->is_search() && $query->is_main_query() ) {
        add_filter('posts_search', 'custom_search_query_post', 10, 2);
    }
}
add_action('pre_get_posts', 'custom_search_query');

function custom_search_query_post($search, $query) {
    global $wpdb;

    if ( empty($search) ) {
        return $search;
    }

    $search_term = $query->get('s');

	$search .= " OR EXISTS (
		SELECT 1 
		FROM {$wpdb->prefix}terms AS t
		INNER JOIN {$wpdb->prefix}term_taxonomy AS tt ON t.term_id = tt.term_id
		INNER JOIN {$wpdb->prefix}term_relationships AS tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
		WHERE t.name LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%'
		AND tr.object_id = {$wpdb->posts}.ID
	)";


    return $search;
}
//конец добавляем к поиску поиск по атрибутам

// Удаляем стандартную функцию вывода описания
remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
// Добавляем нашу функцию для вывода описания без заголовка <h2>
add_action( 'woocommerce_product_tabs', 'custom_woocommerce_product_description_tab', 10 );
function custom_woocommerce_product_description_tab( $tabs ) {
    global $post;
    if ( $post->post_content ) {
        $tabs['description'] = array(
            'title'    => __( 'Description', 'woocommerce' ),
            'priority' => 10,
            'callback' => 'custom_woocommerce_product_description_tab_content'
        );
    }
    return $tabs;
}
function custom_woocommerce_product_description_tab_content() {
    global $post;
    if ( $post->post_content ) {
        echo apply_filters( 'the_content', $post->post_content );
    }
}

//удаляем хлебные крошки woocomerce
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

//хлебные крошки yoast seo
function custom_breadcrumb_home_text($link_output) {
    if (!is_front_page()) {
        return str_replace('Главная страница', 'Главная', $link_output);
    }
    return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'custom_breadcrumb_home_text');

//удаляем разделить в хлебных крошках yoast seo
function custom_breadcrumb_separator($output) {
    $output = str_replace('»', '', $output);
    return $output;
}
add_filter('wpseo_breadcrumb_separator', 'custom_breadcrumb_separator');

//добавляем доп спан чтобы правильно применялись стили для текста
function wrap_breadcrumbs_link_text($link_output) {
    if (preg_match('/<a[^>]*>(.*?)<\/a>/', $link_output, $matches)) {
        $new_link_output = str_replace($matches[1], '<span class="breadcrums-link-text">' . $matches[1] . '</span>', $link_output);
        return $new_link_output;
    }
    return $link_output;
}
add_filter('wpseo_breadcrumb_single_link', 'wrap_breadcrumbs_link_text');


//начало вывод 2-й картинки для категорий на стр категорий
// Функция для извлечения первой картинки из описания категории
function get_first_image_from_description($description) {
    if (preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $description, $matches)) {
        return $matches[1];
    }
    return false;
}

// Функция для отображения категорий с дополнительными картинками из описания
function display_categories_with_additional_image() {
    ob_start(); // Начинаем буферизацию вывода

    $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => 0,
        'hide_empty' => false,
    ));

    if (is_wp_error($terms)) {
        return 'Ошибка получения категорий: ' . $terms->get_error_message();
    }

    if ($terms) {
        echo '<ul class="product-categories">';
        foreach ($terms as $term) {
            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);
            $description = term_description($term->term_id, 'product_cat');
            $additional_image = get_first_image_from_description($description);
            $term_link = get_term_link($term);

            echo '<li class="product-category">';
            
            // Вывод дополнительной картинки из описания если ее нет то выводим основновную миниатюру
            if ($additional_image) {
                echo '<img src="' . esc_url($additional_image) . '" alt="' . esc_attr($term->name) . '">';
            } elseif ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<h3 class="product-category__title">' . esc_html($term->name) . '</h3>';
            echo '<a href="' . esc_url($term_link) . '" class="product-category__link"></a>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Категории не найдены.';
    }

    return ob_get_clean(); // Возвращаем буферизированный вывод
}
add_shortcode('categories_with_additional_image', 'display_categories_with_additional_image');

//конец вывод 2-й картинки для категорий на стр категорий

function search_block_custom() {
    ob_start(); // Начинаем буферизацию вывода чтобы не было ошибки Ошибка обновления. Ответ не является допустимым ответом JSON.
    ?>
    <div class="block-search__white">
        <div class="block-search__inner">
            <h3>Поиск вала по номеру</h3>
            <form role="search" method="get" class="woocommerce-product-search header-search" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Поиск вала по номеру" value="<?php echo get_search_query(); ?>" name="s" />
                <button class="header-search__button" type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>"><span class="icon-Search-3"></span></button>
                <input type="hidden" name="post_type" value="product" />
            </form>
        </div>
    </div>
    <?php
    return ob_get_clean(); // Возвращаем буферизированный вывод
}
add_shortcode('search_block_custom', 'search_block_custom');

// меняем title в карточке товара
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<h5 class="txt-medium' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h5>';
	}
}

//получаем картинку из категории
function get_image_from_category() {
    global $product;
	
    if ( empty( $product ) ) {
        return;
    }

    // Получаем ID продукта
	$product_id = $product->get_id();

	// Получаем категории продукта
	$product_categories = get_the_terms( $product_id, 'product_cat' );

	if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
		echo '<div class="product-category__img">';

		foreach ( $product_categories as $category ) {
			$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
			$image_url = wp_get_attachment_url( $thumbnail_id );

			if ( $image_url ) {
				echo '<div class="category-image">';
				echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $category->name ) . '" />';
				echo '</div>';
			}
		}

		echo '</div>';
	}
}

//удаляем исходную сортировку из видов сортировки
function remove_orderby_options( $sortby ) {
	unset( $sortby[ 'menu_order' ] ); // исходная сортировка
    unset( $sortby[ 'popularity' ] ); // по популярности
    unset( $sortby[ 'date' ] ); // по новизне
	return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'remove_orderby_options' );
add_filter( 'woocommerce_catalog_orderby', 'remove_orderby_options' );


//начало добавляем сортировку длина мм
// Вывод формы фильтрации
function print_length_filter() {
    $min_length = isset($_GET['min_length']) && $_GET['min_length'] !== '' ? intval($_GET['min_length']) : 0;
    $max_length = isset($_GET['max_length']) ? intval($_GET['max_length']) : '';

    echo '<form class="length-filter subtitle" method="get">';
    echo '<span>Длина в сжатом положении:</span>';
    echo '<input class="subtitle" placeholder="от" type="number" id="min_length" name="min_length" value="' . esc_attr($min_length) . '" />';
    echo '<input class="subtitle" placeholder="до" type="number" id="max_length" name="max_length" value="' . esc_attr($max_length) . '" />';
    echo '<input class="subtitle" type="submit" value="Фильтровать" />';
    echo '</form>';

    // Создаем URL для очистки фильтров
    if ($min_length || $max_length) {
        $query_params = $_GET;
        // Удаляем параметры min_length и max_length
        unset($query_params['min_length'], $query_params['max_length']);
        // Генерируем новый URL без этих параметров
        $clear_filters_url = '?' . http_build_query($query_params);

        echo '<a href="' . esc_url($clear_filters_url) . '" class="clear-filters subtitle">Очистить фильтры</a>';
    }
}

// Фильтрация продуктов по длине
function filter_products_by_length( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') ) ) {
        global $wpdb;
        $min_length = isset($_GET['min_length']) ? intval($_GET['min_length']) : 0;
        $max_length = isset($_GET['max_length']) ? intval($_GET['max_length']) : '';

        if ($min_length || $max_length) {
            add_filter('posts_join', function($join) {
                global $wpdb;
                $join .= " LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id";
                $join .= " LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
                $join .= " LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id";
                return $join;
            });

            add_filter('posts_where', function($where) use ($min_length, $max_length, $wpdb) {
                $where .= " AND tt.taxonomy = 'pa_length-compressed-position'";
                if ($min_length) {
                    $where .= $wpdb->prepare(" AND CAST(t.name AS UNSIGNED) >= %d", $min_length);
                }
                if ($max_length) {
                    $where .= $wpdb->prepare(" AND CAST(t.name AS UNSIGNED) <= %d", $max_length);
                }
                return $where;
            });

            add_filter('posts_distinct', function($distinct) {
                return 'DISTINCT';
            });
        }
    }
}
add_action('pre_get_posts', 'filter_products_by_length');

// Проверка наличия товаров перед запросом
function check_products_exist_for_length_filter() {
    if (is_shop() || is_tax('product_cat')) {
        global $wpdb;

        $min_length = isset($_GET['min_length']) ? intval($_GET['min_length']) : 0;
        $max_length = isset($_GET['max_length']) ? intval($_GET['max_length']) : '';

        if ($min_length || $max_length) {
            $query = "SELECT DISTINCT p.ID
                      FROM {$wpdb->posts} p
                      LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
                      LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                      LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
                      WHERE p.post_type = 'product'
                        AND p.post_status = 'publish'
                        AND tt.taxonomy = 'pa_length-compressed-position'";

            if ($min_length) {
                $query .= $wpdb->prepare(" AND CAST(t.name AS UNSIGNED) >= %d", $min_length);
            }
            if ($max_length) {
                $query .= $wpdb->prepare(" AND CAST(t.name AS UNSIGNED) <= %d", $max_length);
            }

            $results = $wpdb->get_col($query);

            if (empty($results)) {
                // Отменяем стандартный запрос
                add_filter('pre_get_posts', function($query) {
                    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') ) ) {
                        $query->set('post__in', array(0)); // Возвращаем пустые результаты
                    }
                });
            }
        }
    }
}
add_action('wp', 'check_products_exist_for_length_filter');


// Сортировка по длине
function custom_woocommerce_get_catalog_ordering_attr_args( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') ) ) {
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';

        if ( 'length_asc' === $orderby || 'length_desc' === $orderby ) {
            add_filter('posts_clauses', function($clauses, $wp_query) use ($orderby) {
                global $wpdb;

                // Проверяем, что запрос связан с продуктами WooCommerce
                if ( isset($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'product' ) {
                    
                    //  JOINим 3 связанные таблицы чтобы найти данные по таксономии
                    $clauses['join'] .= " LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id 
                                          LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                                          LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id";
                    
                    $clauses['where'] .= " AND tt.taxonomy = 'pa_length-compressed-position'";

                    // Устанавливаем порядок сортировки по убыванию length_desc или возрастанию length_asc
                    $clauses['orderby'] = "CAST(t.name AS UNSIGNED) " . ('length_asc' === $orderby ? 'ASC' : 'DESC');
                }

                return $clauses;
            }, 10, 2);
        }
    }
}
add_action('pre_get_posts', 'custom_woocommerce_get_catalog_ordering_attr_args');

// Добавление пользовательских параметров сортировки
function custom_orderby_option( $sortby ) {
    $sortby['length_asc'] = 'Длина, мм ⬆'; 
    $sortby['length_desc'] = 'Длина, мм ⬇';
    return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_orderby_option' );
add_filter( 'woocommerce_catalog_orderby', 'custom_orderby_option' );
//конец добавляем сортировку длина мм



function custom_woocommerce_ajax_add_to_cart() {
    // Получаем идентификатор товара и количество из POST-запроса
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    
    // Проверяем, валидно ли добавление товара в корзину
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    // Если добавление валидно и статус товара "publish", добавляем товар в корзину
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        
        do_action('woocommerce_ajax_added_to_cart', $product_id);

        // Если опция перенаправления после добавления включена, добавляем сообщение
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        // Возвращаем обновленные фрагменты корзины
        WC_AJAX::get_refreshed_fragments();
    } else {
        // Если добавление не удалось, возвращаем ошибку и URL товара
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );

        echo wp_send_json($data);
    }

    wp_die();
}
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'custom_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'custom_woocommerce_ajax_add_to_cart');

//Обработчик для обновления количества товаров в корзине
function update_cart_count() {
    wp_send_json_success(array(
        'cart_count' => WC()->cart->get_cart_contents_count()
    ));
}
add_action('wp_ajax_update_cart_count', 'update_cart_count');
add_action('wp_ajax_nopriv_update_cart_count', 'update_cart_count');

//поддержка WooCommerce
function custom_add_woocomerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'custom_add_woocomerce_support' );