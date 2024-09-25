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

    foreach ($menu_items as $menu_item) {
        $menu_item_url = rtrim($menu_item->url, '/'); 
        
        if ($menu_item->url === '#catalog') {
            continue;
        }

        // Если текущий URL совпадает с URL элемента меню, добавляем класс
        if ($menu_item_url === $current_url) {
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
        $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
        $comment = isset($_POST['comment']) ? sanitize_textarea_field($_POST['comment']) : '';

        $to = 'info@kamkardan.ru'; // email клиента
        
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
        if (!empty($email)) {
            $message .= "\nEmail: " . $email;
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
			],
			'banner' => [
				'description' => __('Блок-баннер', 'kamkardan'),
				'title' => __('Блок баннер', 'kamkardan'),
				'keywords' => array('Блок-баннер', 'баннер')
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

function genius_display_discount_badge_return() {
    global $product;

    $discount = get_post_meta($product->get_id(), '_pc_discount', true);
    if ($discount && $discount > 0) {
        return '<span class="discount-badge"><span class="square"><span class="circle"></span></span>-' . esc_html($discount) . '%</span>';
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
//конец делаем sidebar с категориями на странице продукта и продуктов

//начало вывод меток и подкатегорий категории карданы
function add_kardany_tags_and_subcategories_sidebar() {
    // Получаем текущий объект запроса
    $current_object = get_queried_object();
    
    // Начальные значения
    $current_term_ids = [];

    // Проверяем, является ли текущая страница категорией, меткой или товаром
    if (is_product_category() || is_product_tag()) {
        $current_term_ids[] = $current_object->term_id;
    } elseif (is_product()) {
        // Если находимся на странице товара, получаем категории и метки товара
        $product_id = get_the_ID();
        $product_cats = wp_get_post_terms($product_id, 'product_cat');
        $product_tags = wp_get_post_terms($product_id, 'product_tag');

        // Добавляем все категории и метки товара в текущие термины
        foreach ($product_cats as $cat) {
            $current_term_ids[] = $cat->term_id;
        }
        foreach ($product_tags as $tag) {
            $current_term_ids[] = $tag->term_id;
        }
    }

    // Получаем отсортированные подкатегории и метки
    $terms = get_sorted_product_tags_and_subcategories();

    // Фильтруем метки и подкатегории
    $tags = array_filter($terms, function($term) {
        return $term->taxonomy == 'product_tag';
    });

    $subcategories = array_filter($terms, function($term) {
        return $term->taxonomy == 'product_cat' && $term->parent != 0;
    });

    // Если есть метки или подкатегории, выводим их
    if (!empty($tags) || !empty($subcategories)) {
        ?>
        <aside class="product-category-sidebar">
            <div id="catalog-sidebar" class="category-list-categories mobile">
                <h3 class="margin-bottom-16">Карданы</h3>

                <?php if (!empty($tags)) : ?>
                    <ul class="category-list">
                        <?php foreach ($tags as $tag) : 
                            // Получаем значение поля "logo"
                            $logo_field = get_field('logo', $tag);
                            if (is_numeric($logo_field)) {
                                $image_url = wp_get_attachment_url($logo_field);
                            } else {
                                $image_url = $logo_field; // Предполагаем, что это уже URL
                            }
                            $link = get_term_link($tag);
                            $selected_class = in_array($tag->term_id, $current_term_ids) ? ' selected' : '';
                        ?>
                            <li id="tag-item-<?php echo esc_attr($tag->term_id); ?>" class="cat-item cat-item-<?php echo esc_attr($tag->term_id); ?><?php echo esc_attr($selected_class); ?>">
                                <a class="cat-link" href="<?php echo esc_url($link); ?>">
                                    <?php if ($image_url) : ?>
                                        <img class="cat-image" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($tag->name); ?>" />
                                    <?php endif; ?>
                                    <span class="cat-name"><?php echo esc_html($tag->name); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if (!empty($subcategories)) : ?>
                    <ul class="category-list">
                        <?php foreach ($subcategories as $subcategory) : 
                            // Получаем миниатюру подкатегории
                            $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                            $image_url = wp_get_attachment_url($thumbnail_id);
                            $link = get_term_link($subcategory);
                            $selected_class = in_array($subcategory->term_id, $current_term_ids) ? ' selected' : '';
                        ?>
                            <li id="cat-item-<?php echo esc_attr($subcategory->term_id); ?>" class="cat-item cat-item-<?php echo esc_attr($subcategory->term_id); ?><?php echo esc_attr($selected_class); ?>">
                                <a class="cat-link" href="<?php echo esc_url($link); ?>">
                                    <?php if ($image_url) : ?>
                                        <img class="cat-image" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($subcategory->name); ?>" />
                                    <?php endif; ?>
                                    <span class="cat-name"><?php echo esc_html($subcategory->name); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
        <?php
    }
}
add_shortcode('kardany_tags_and_subcategories', 'add_kardany_tags_and_subcategories_sidebar');


//вывод номера кардана из атрибутов на странице товара и карточке
function custom_woocommerce_attr_num_cardan() {
    if ( is_product() || is_shop() || is_product_category() || is_front_page()) {
        global $product;
        
        // Получаем все атрибуты товара
        $attributes = $product->get_attributes();

        if ( isset( $attributes['pa_cardan-shaft-number'] ) ) {
            $attribute = $attributes['pa_cardan-shaft-number'];

            $terms = wc_get_product_terms( $product->get_id(), 'pa_cardan-shaft-number', array( 'fields' => 'names' ) );

            if ( ! empty( $terms ) ) {
                $value = implode( ', ', $terms );
                echo '<p class="product-attribute-cardan-shaft-number">Артикул кардана: <span>' . esc_html( $value ) . '</span></p>';
            }
        }
    }
}
add_action('custom_woocommerce_attr_num_cardan', 'custom_woocommerce_attr_num_cardan');
add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_attr_num_cardan', 15);

function custom_woocommerce_sku_on_product_card() {
    if ( is_product() || is_shop() || is_product_category() || is_front_page() || is_product_tag()) {
        global $product;

        // Получаем артикул (SKU) товара
        $sku = $product->get_sku();

        // Проверяем, если артикул существует
        if ( ! empty( $sku ) ) {
            echo '<p class="product-attribute-cardan-shaft-number">Артикул кардана: <span>' . esc_html( $sku ) . '</span></p>';
        }
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'custom_woocommerce_sku_on_product_card', 15);


//вывод аттрибутов на карточке товаров
// Функция для вывода атрибутов
function display_product_attribute($product, $attribute_key) {
    $attributes = $product->get_attributes();

    // Специальный вывод для применяемости
    if ( $attribute_key == 'pa_application' && isset( $attributes['pa_application'] ) ) {
        $terms = wc_get_product_terms( $product->get_id(), 'pa_application', array( 'fields' => 'names' ) );
        $attribute_name = wc_attribute_label( 'pa_application', $product );

        // if ( ! empty( $terms ) ) {
        //     $value = implode( ', ', $terms );
        //     echo '<p class="product-attribute-length-compressed-position">' . esc_html($attribute_name) . '<br><span class="product-attribute-application">' . esc_html( $value ) . '</span></p>';
        // }
    }

    // Вывод для всех остальных атрибутов
    if ( $attribute_key !== 'pa_application' && isset( $attributes[ $attribute_key ] ) ) {
        $terms = wc_get_product_terms( $product->get_id(), $attribute_key, array( 'fields' => 'names' ) );
        $attribute_name = wc_attribute_label( $attribute_key, $product );

        // if ( ! empty( $terms ) ) {
        //     $value = implode( ', ', $terms );
        //     echo '<p class="product-attribute-length-compressed-position">' . esc_html($attribute_name) . ' <span>' . esc_html( $value ) . '</span></p>';
        // }
    }
}

function custom_woocommerce_attr_len_cardan() {
    $product = wc_get_product(get_the_ID());

    // Массив с ключами нужных атрибутов
    $attribute_keys = array(
        'pa_application',
        'pa_length-compressed-position',
        'pa_bearing-outerd-mm',
        'pa_dimensions-at-ends-h-mm'
    );

    // Перебор атрибутов и вывод
    foreach ( $attribute_keys as $attribute_key ) {
        display_product_attribute( $product, $attribute_key );
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'custom_woocommerce_attr_len_cardan', 15);

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

//начало хлебные крошки
//удаляем хлебные крошки woocomerce
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// Добавляем хлебные крошки только на страницах товаров
function add_woocommerce_breadcrumbs_to_product_page() {
    if (is_singular('product')) {
        woocommerce_breadcrumb();
    }
}
add_action('woocommerce_before_main_content', 'add_woocommerce_breadcrumbs_to_product_page', 20);
function custom_woocommerce_breadcrumb_separator($defaults) {
    // Удаляем символ '/'
    $defaults['delimiter'] = '';
    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumb_separator');
//добавляем спан чтобы стили можно было правильно импользовать
function wrap_woocommerce_breadcrumbs_link_text($crumbs) {
    foreach ($crumbs as &$crumb) {
        if (!empty($crumb[1])) {
            $crumb[0] = `<span>` . $crumb[0] . `</span>`;
        }
    }
    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'wrap_woocommerce_breadcrumbs_link_text');

//фильтр меняем /product-category/kardany/ на /all-cardans/
// add_filter('woocommerce_get_breadcrumb', 'custom_woocommerce_breadcrumb', 20, 2);
// function custom_woocommerce_breadcrumb($crumbs, $breadcrumb) {
//     // ID категории "Карданы"
//     $target_category_id = 154; 
//     $replacement_url = '/all-cardans/';
//     $replacement_label = 'Все карданы';

//     // Проверяем, находимся ли мы на странице товара
//     if (is_product()) {
//         global $post;

//         // Получаем категории товара
//         $terms = get_the_terms($post->ID, 'product_cat');

//         // Проверяем, принадлежит ли товар к категории "Карданы" или ее подкатегориям
//         if ($terms && !is_wp_error($terms)) {
//             // Получаем подкатегории категории "Карданы"
//             $all_kardan_categories = get_term_children($target_category_id, 'product_cat');
//             // Добавляем основную категорию "Карданы"
//             $all_kardan_categories[] = $target_category_id;

//             // Флаг для проверки, принадлежит ли товар к категории "Карданы" или ее подкатегориям
//             $is_kardan_product = false;

//             foreach ($terms as $term) {
//                 // Проверяем, находится ли текущая категория в массиве подкатегорий или основной категории
//                 if (in_array($term->term_id, $all_kardan_categories)) {
//                     $is_kardan_product = true; // Устанавливаем флаг
//                     break; // Прерываем цикл, если нашли соответствие
//                 }
//             }

//             // Если товар принадлежит к категории "Карданы" или её подкатегориям
//             if ($is_kardan_product) {
//                 foreach ($crumbs as $key => $crumb) {
//                     // Проверяем, является ли текущая хлебная крошка категорией "Карданы"
//                     if (strpos($crumb[1], '/product-category/kardany/') !== false) {
//                         // Заменяем ссылку и название хлебной крошки только на основную категорию "Карданы"
//                         $crumbs[$key][0] = $replacement_label; // Меняем текст
//                         $crumbs[$key][1] = $replacement_url;   // Меняем ссылку
//                         break; // Прерываем цикл после первой замены
//                     }
//                 }
//             }
//         }
//     }

//     return $crumbs;
// }
function custom_woocommerce_breadcrumb($crumbs, $breadcrumb) {
    $target_category_id = 154; // ID категории "Карданы"
    $replacement_url = '/all-cardans/';
    $replacement_label = 'Все карданы';

    // Проверяем, находимся ли мы на странице товара или страницы категории
    if (is_product() || is_product_category()) {
        global $post;

        // Массив для проверки принадлежности к категории или подкатегориям
        $product_categories = [];

        if (is_product()) {
            // Получаем категории товара
            $terms = get_the_terms($post->ID, 'product_cat');
            if ($terms && !is_wp_error($terms)) {
                $product_categories = wp_list_pluck($terms, 'term_id');
            }
        } elseif (is_product_category()) {
            // Получаем ID текущей категории или подкатегории
            $current_cat = get_queried_object();
            $product_categories = [$current_cat->term_id];
        }

        // Получаем подкатегории категории "Карданы"
        $all_kardan_categories = get_term_children($target_category_id, 'product_cat');
        // Добавляем основную категорию "Карданы"
        $all_kardan_categories[] = $target_category_id;

        // Проверка, принадлежит ли текущий товар или категория к категории "Карданы" или ее подкатегориям
        $is_kardan_category = !empty(array_intersect($product_categories, $all_kardan_categories));

        // Если товар или категория принадлежит к "Карданы" или ее подкатегориям
        if ($is_kardan_category) {
            foreach ($crumbs as $key => $crumb) {
                // Проверяем, является ли текущая хлебная крошка категорией "Карданы"
                if (strpos($crumb[1], '/product-category/kardany/') !== false && $crumb[0] === 'Карданы') {
                    // Заменяем ссылку и название хлебной крошки
                    $crumbs[$key][0] = $replacement_label; // Меняем текст
                    $crumbs[$key][1] = $replacement_url;   // Меняем ссылку
                    break;
                }
            }
        }
    }

    return $crumbs;
}
add_filter('woocommerce_get_breadcrumb', 'custom_woocommerce_breadcrumb', 20, 2);

//хлебные крошки yoast seo
function custom_breadcrumb_home_text($link_output) {
    if (is_singular('product')) {
        return ''; 
    }
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
//конец хлебные крошки


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

    // Получаем отсортированные категории с использованием кастомной функции
    $terms = get_sorted_product_categories();

    if (empty($terms)) {
        return 'Категории не найдены.';
    }

    echo '<ul class="product-categories">';
    foreach ($terms as $term) {
        // Исключаем категории с названиями 'Крестовины', 'Комплектующие', 'Подобрать кардан'
        if((esc_html($term->name) !== 'Крестовины') && 
           (esc_html($term->name) !== 'Комплектующие') && 
           (esc_html($term->name) !== 'Подобрать кардан')) {

            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);
            $description = term_description($term->term_id, 'product_cat');
            $additional_image = get_first_image_from_description($description);
            $term_link = get_term_link($term);

            echo '<li class="product-category">';
            
            // Вывод дополнительной картинки из описания, если она есть, иначе выводим основную миниатюру
            if ($additional_image) {
                echo '<img src="' . esc_url($additional_image) . '" alt="' . esc_attr($term->name) . '">';
            } elseif ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }

            echo '<h3 class="product-category__title">' . esc_html($term->name) . '</h3>';
            echo '<a href="' . esc_url($term_link) . '" class="product-category__link"></a>';
            echo '</li>';
        }
    }
    echo '</ul>';

    return ob_get_clean(); // Возвращаем буферизированный вывод
}
add_shortcode('categories_with_additional_image', 'display_categories_with_additional_image');
//конец вывод 2-й картинки для категорий на стр категорий

//начало вывод подкатегорий и меток
function display_kardany_subcategories_and_tags() {
    ob_start(); // Начинаем буферизацию вывода

    // Получаем отсортированные подкатегории и метки
    $terms = get_sorted_product_tags_and_subcategories();

    if (empty($terms)) {
        return 'Подкатегории и метки не найдены.';
    }

    // Вывод всех меток (tags)
    echo '<ul class="product-categories">';
    foreach ($terms as $term) {
        if ($term->taxonomy == 'product_tag') {
            // Попытка получить изображение из ACF поля "img-big"
            $image = get_field('img-big', $term);
            if (!$image) {
                // Если img-big отсутствует, пытаемся получить из "logo"
                $image = get_field('logo', $term);
            }

            $tag_link = get_term_link($term);

            echo '<li class="product-category">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<h4 class="product-category__title">' . esc_html($term->name) . '</h4>';
            echo '<a class="product-category__link" href="' . esc_url($tag_link) . '"></a>';
            echo '</li>';
        }
    }

    // Вывод всех подкатегорий (product_cat)
    foreach ($terms as $term) {
        // Проверяем, является ли элемент подкатегорией (product_cat)
        if ($term->taxonomy == 'product_cat' && $term->parent != 0) {
            // Попытка получить изображение из ACF поля "img-big"
            $image = get_field('img-big', $term);
            if (!$image) {
                // Если img-big отсутствует, используем стандартное миниатюрное изображение
                $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);
            }

            $term_link = get_term_link($term);

            echo '<li class="product-category">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<h4 class="product-category__title">' . esc_html($term->name) . '</h4>';
            echo '<a href="' . esc_url($term_link) . '" class="product-category__link"></a>';
            echo '</li>';
        }
    }
    echo '</ul>';

    return ob_get_clean(); // Возвращаем буферизированный вывод
}
add_shortcode('kardany_subcategories_and_tags', 'display_kardany_subcategories_and_tags');

function display_kardany_all_subcategories_and_tags() {
    ob_start(); // Начинаем буферизацию вывода

    // Получаем отсортированные подкатегории и метки
    $terms = get_sorted_product_tags_and_subcategories();

    if (empty($terms)) {
        return 'Подкатегории и метки не найдены.';
    }

    // Список для меток на русском языке
    echo '<ul class="russian-tags">';
    foreach ($terms as $term) {
        if ($term->taxonomy == 'product_tag' && is_russian($term->name)) {

            $image = get_field('logo', $term);
            $tag_link = get_term_link($term);

            echo '<li class="catalog-product-category">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<p class="catalog-product-category__txt txt-normal">' . esc_html($term->name) . '</p>';
            echo '<a class="catalog-product-category__link" href="' . esc_url($tag_link) . '"></a>';
            echo '</li>';
        }
    }
    echo '</ul>';

    // Список для меток на английском языке
    echo '<ul class="english-tags">';
    foreach ($terms as $term) {
        if ($term->taxonomy == 'product_tag' && !is_russian($term->name)) {

            $image = get_field('logo', $term);
            $tag_link = get_term_link($term);

            echo '<li class="catalog-product-category">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<p class="catalog-product-category__txt txt-normal">' . esc_html($term->name) . '</p>';
            echo '<a class="catalog-product-category__link" href="' . esc_url($tag_link) . '"></a>';
            echo '</li>';
        }
    }
    echo '</ul>';

    // Список подкатегорий и категорий ('crosspieces', 'accessories')
    echo '<ul class="subcategories-and-specific-categories">';
    foreach ($terms as $term) {
        // Проверяем, является ли элемент подкатегорией (product_cat)
        if ($term->taxonomy == 'product_cat' && $term->parent != 0) {

            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);
            $term_link = get_term_link($term);

            echo '<li class="catalog-product-category">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<p class="catalog-product-category__txt">' . esc_html($term->name) . '</p>';
            echo '<a href="' . esc_url($term_link) . '" class="product-category__link"></a>';
            echo '</li>';
        }
    }

    // Получаем конкретные категории 'crosspieces' и 'accessories'
    $specific_terms = ['crosspieces', 'accessories'];
    foreach ($specific_terms as $slug) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if ($term) {
            $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);
            $term_link = get_term_link($term);

            echo '<li class="catalog-product-category">';
            if ($image) {
                echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($term->name) . '">';
            }
            echo '<p class="catalog-product-category__txt">' . esc_html($term->name) . '</p>';
            echo '<a href="' . esc_url($term_link) . '" class="product-category__link"></a>';
            echo '</li>';
        }
    }
    echo '</ul>';

    return ob_get_clean(); // Возвращаем буферизированный вывод
}
add_shortcode('kardany_all_subcategories_and_tags', 'display_kardany_all_subcategories_and_tags');

function is_russian($text) {
    return preg_match('/[\p{Cyrillic}]/u', $text);
}
//конец вывод подкатегорий и меток


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
		echo '<h5 class="txt-medium ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h5>';
	}
}

function get_image_from_category() {
    // Получаем текущий объект (метку, категорию или подкатегорию)
    $current_object = get_queried_object();

    if ( ! empty( $current_object ) && ! is_wp_error( $current_object ) ) {
        $image_url = '';

        // Проверяем, что текущий объект — это категория или метка
        if ( ! empty( $current_object ) && ! is_wp_error( $current_object ) ) {
            $image_url = '';
            
            // Проверяем, что текущий объект — это категория или подкатегория

            if ( isset($current_object->taxonomy) && ($current_object->taxonomy === 'product_tag') ) {
                // Это метка
                $logo_field = get_field('logo', 'product_tag_' . $current_object->term_id);
                if ( $logo_field ) {
                    $image_url = esc_url($logo_field);
                }
            } else  {
                // Это категория или подкатегория
                $thumbnail_id = get_term_meta( $current_object->term_id, 'thumbnail_id', true );
                $image_url = wp_get_attachment_url( $thumbnail_id );
            }
        
        // Если есть URL изображения, выводим его
            if ( $image_url ) {
                echo '<div class="category-image">';
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($current_object->name) . '" />';
                echo '</div>';
            }
        }
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
// Функция для отображения фильтра длины
function print_length_filter() {
    $min_length = isset($_GET['min_length']) && $_GET['min_length'] !== '' ? intval($_GET['min_length']) : 0;
    $max_length = isset($_GET['max_length']) ? intval($_GET['max_length']) : '';

    echo '<form class="length-filter subtitle" method="get">';
    echo '<span>Длина в сжатом положении:</span>';
    echo '<div class="length-filter__block"><input class="subtitle" placeholder="от" type="number" id="min_length" name="min_length" value="' . esc_attr($min_length) . '" />';
    echo '<input class="subtitle" placeholder="до" type="number" id="max_length" name="max_length" value="' . esc_attr($max_length) . '" /></div>';
    echo '<input class="subtitle" type="submit" value="Применить" />';
    echo '</form>';

    // Создаем URL для очистки фильтров
    if ($min_length || $max_length) {
        $query_params = $_GET;
        unset($query_params['min_length'], $query_params['max_length']);
        $clear_filters_url = '?' . http_build_query($query_params);

        echo '<a href="' . esc_url($clear_filters_url) . '" class="clear-filters subtitle">Очистить фильтры</a>';
    }
}

// Фильтрация продуктов по длине
function filter_products_by_length( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') || is_tax('product_tag') ) ) {
        global $wpdb;
        $min_length = isset($_GET['min_length']) ? intval($_GET['min_length']) : 0;
        $max_length = isset($_GET['max_length']) ? intval($_GET['max_length']) : '';

        if ($min_length || $max_length) {
            // Добавляем фильтры
            add_filter('posts_join', 'custom_posts_join');
            add_filter('posts_where', 'custom_posts_where', 10, 2);
            add_filter('posts_distinct', 'custom_posts_distinct');

            // Удаляем фильтры после запроса
            add_action('wp', 'remove_custom_filters');
        }
    }
}

function custom_posts_join($join) {
    global $wpdb;
    $join .= " LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id";
    $join .= " LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
    $join .= " LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id";
    return $join;
}

function custom_posts_where($where, $query) {
    global $wpdb;
    $min_length = isset($_GET['min_length']) ? intval($_GET['min_length']) : 0;
    $max_length = isset($_GET['max_length']) ? intval($_GET['max_length']) : '';

    $where .= " AND tt.taxonomy = 'pa_length-compressed-position'";
    if ($min_length) {
        $where .= $wpdb->prepare(" AND CAST(t.name AS UNSIGNED) >= %d", $min_length);
    }
    if ($max_length) {
        $where .= $wpdb->prepare(" AND CAST(t.name AS UNSIGNED) <= %d", $max_length);
    }
    return $where;
}

function custom_posts_distinct($distinct) {
    return 'DISTINCT';
}

function remove_custom_filters() {
    remove_filter('posts_join', 'custom_posts_join');
    remove_filter('posts_where', 'custom_posts_where');
    remove_filter('posts_distinct', 'custom_posts_distinct');
}
add_action('pre_get_posts', 'filter_products_by_length', 20);


// Проверка наличия товаров перед запросом
function check_products_exist_for_length_filter() {
    if (is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
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
                    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') || is_tax('product_tag') ) ) {
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
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') || is_tax('product_tag') ) ) {
        $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';

        if ( 'length_asc' === $orderby || 'length_desc' === $orderby ) {
            add_filter('posts_clauses', 'custom_posts_clauses_for_ordering', 10, 2);
            
            // Удаляем фильтр после запроса
            add_action('wp', 'remove_custom_posts_clauses_for_ordering');
        }
    }
}

function custom_posts_clauses_for_ordering($clauses, $wp_query) {
    global $wpdb;

    // Убедитесь, что фильтр применяется только к основному запросу WooCommerce
    if (is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
        $clauses['join'] .= " LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id 
                                LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                                LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id";

        $clauses['where'] .= $wpdb->prepare(" AND tt.taxonomy = %s", 'pa_length-compressed-position');

        // Сортировка по длине (числовое значение из term.name)
        $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'length_asc';
        $clauses['orderby'] = "CAST(t.name AS UNSIGNED) " . ('length_asc' === $orderby ? 'ASC' : 'DESC');
    }

    return $clauses;
}

function remove_custom_posts_clauses_for_ordering() {
    remove_filter('posts_clauses', 'custom_posts_clauses_for_ordering');
}

add_action('pre_get_posts', 'custom_woocommerce_get_catalog_ordering_attr_args', 20);



// Добавление пользовательских параметров сортировки
function custom_orderby_option( $sortby ) {
    global $wp_query;

    $sortby['default'] = '<span class="icon-Frame-10"></span>Сортировать'; 
    
    $default_sort = array('default' => '<span class="icon-Frame-10"></span>Сортировать');
    $sortby = array_merge($default_sort, $sortby);


    if ( is_product_category() ) {
        $current_category_id = get_queried_object_id();
        $excluded_category_slug = 'crosspieces'; 
        $excluded_category = get_term_by( 'id', $current_category_id, 'product_cat' );

        //если крестовины то не выводим
        if ( $excluded_category && $excluded_category->slug === $excluded_category_slug ) {
            return $sortby;
        }
    }

    // Добавляем новые параметры сортировки, если текущая страница не является категорией "crosspieces"
    $sortby['length_asc'] = 'Длина, мм &uarr;'; 
    $sortby['length_desc'] = 'Длина, мм &darr;';
    return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_orderby_option' );
add_filter( 'woocommerce_catalog_orderby', 'custom_orderby_option' );
//конец добавляем сортировку длина мм

//фильтры по аттриьбутам
function get_category_product_attributes($category_id) {
    global $wpdb;

    // Получаем ID всех продуктов в данной категории
    $product_ids = $wpdb->get_col($wpdb->prepare("
        SELECT object_id
        FROM {$wpdb->term_relationships}
        WHERE term_taxonomy_id = %d
    ", $category_id));

    if (empty($product_ids)) {
        return false;
    }

    $all_attributes = wc_get_attribute_taxonomies();

    // Отфильтровываем только те атрибуты, которые используются в данных продуктах
    $attributes = array();
    foreach ($all_attributes as $attribute) {
        $attribute_name = $attribute->attribute_name;



        // Исключаем атрибут 'product-unit'
        if ($attribute_name === 'product-unit') {
            continue;
        }

        
        $taxonomy = 'pa_' . $attribute->attribute_name;
        $term_count = $wpdb->get_var($wpdb->prepare("
            SELECT COUNT(DISTINCT tr.term_taxonomy_id)
            FROM {$wpdb->term_relationships} AS tr
            INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            WHERE tt.taxonomy = %s
            AND tr.object_id IN (" . implode(',', array_map('intval', $product_ids)) . ")
        ", $taxonomy));


        if ($term_count > 0) {
            $attributes[] = $attribute;
        }
    }

    return $attributes;
}

function print_filters() {
    // Получаем текущий URL
    $current_url = $_SERVER['REQUEST_URI'];

    $category = get_queried_object();

    // Проверяем, является ли объект категорией (WP_Term)
    if (!$category || !($category instanceof WP_Term)) {
        return;
    }

    $category_id = $category->term_id;

    // Получаем атрибуты категории
    if (function_exists('get_category_product_attributes')) {
        $attributes = get_category_product_attributes($category_id);

        // Если атрибуты отсутствуют или это не массив, прекращаем выполнение
        if (!$attributes || !is_array($attributes)) {
            return;
        }

        // Убираем атрибут с названием 'application'
        $attributes = array_filter($attributes, function($attribute) {
            return $attribute->attribute_name !== 'application';
        });

        if (empty($attributes)) {
            return; // Если после фильтрации не осталось атрибутов, выходим из функции
        }
    } else {
        error_log('Функция get_category_product_attributes не определена.');
        return;
    }

    $current_params = $_GET;

    $attribute_params = array_filter($current_params, function($key) {
        return strpos($key, 'attribute_') === 0;
    }, ARRAY_FILTER_USE_KEY);

    $non_attribute_params = array_filter($current_params, function($key) {
        return strpos($key, 'attribute_') !== 0;
    }, ARRAY_FILTER_USE_KEY);

    $has_non_empty_attribute = false;
    foreach ($attribute_params as $value) {
        if (!empty($value)) {
            $has_non_empty_attribute = true;
            break;
        }
    }

    $clear_filters_url = add_query_arg($non_attribute_params, get_term_link($category));
    echo '<div class="attribute-filters"><form method="get" action="#">';

    foreach ($current_params as $key => $value) {
        if (strpos($key, 'attribute_') !== 0) {
            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
        }
    }

    foreach ($attributes as $attribute) {
        $attribute_name = $attribute->attribute_name;
        $attribute_label = $attribute->attribute_label;
        $selected_value = isset($current_params['attribute_' . esc_attr($attribute_name)]) ? $current_params['attribute_' . esc_attr($attribute_name)] : '';

        // Используем input вместо select для ввода числового значения
        echo '<div class="attribute-filters__input" data-attribute="' . esc_attr($attribute_name) . '">';
        echo '<label for="attribute_' . esc_attr($attribute_name) . '">' . esc_html($attribute_label) . '</label>';
        echo '<input type="number" name="attribute_' . esc_attr($attribute_name) . '" id="attribute_' . esc_attr($attribute_name) . '" value="' . esc_attr($selected_value) . '" placeholder="mm">';
        echo '</div>';
    }

    echo '<input class="submit-button" type="submit" value="Применить">';
    echo '</form>';

    if ($has_non_empty_attribute) {
        echo '<a href="' . esc_url($clear_filters_url) . '" class="clear-filters">Очистить фильтры</a>';
    }

    echo '</div>';
}

function custom_woocommerce_get_catalog_ordering_attr_args_not_cardany( $query ) {
    // Проверяем, что это основной запрос и не в админке
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_tax('product_cat') ) ) {
        // Получаем текущую категорию
        if ( is_tax('product_cat') && ! is_tax('product_cat', 'crosspieces') ) {
            // Если это не нужная категория, выходим из функции
            return;
        }
        
        // Получаем текущие параметры запроса
        $query_vars = $query->query_vars;

        // Инициализация массива tax_query, если он не существует
        if ( ! isset( $query_vars['tax_query'] ) ) {
            $query_vars['tax_query'] = array();
        }

        // Итерируемся по параметрам запроса и добавляем фильтрацию по атрибутам
        foreach ( $_GET as $key => $value ) {
            if ( strpos( $key, 'attribute_' ) === 0 && ! empty( $value ) ) {
                $attribute = str_replace( 'attribute_', '', $key );
                $taxonomy = 'pa_' . $attribute;

                // Добавляем фильтр в tax_query
                $query_vars['tax_query'][] = array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => sanitize_title( $value ),
                    'operator' => 'IN',
                );
            }
        }

        // Устанавливаем измененные параметры обратно в запрос
        $query->set( 'tax_query', $query_vars['tax_query'] );
    }
}
add_action( 'pre_get_posts', 'custom_woocommerce_get_catalog_ordering_attr_args_not_cardany' );



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
    if (!isset($_POST['action']) || $_POST['action'] !== 'update_cart_count') {
        wp_send_json_error('Неверный запрос');
    }

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

//выводим 8 лучших карданных валов - исключаем комплектующие и крестовины
function custom_best_selling_products($atts) {
    $exclude_categories = array('accessories', 'crosspieces'); //исключаем крестовины и комплектующие

    // Получаем ID категорий для исключения
    $exclude_ids = array();
    foreach ($exclude_categories as $category_slug) {
        $category = get_term_by('slug', $category_slug, 'product_cat');
        if ($category) {
            $exclude_ids[] = $category->term_id;
        }
    }

    // Настройки для запроса продуктов
    $args = array(
        'posts_per_page' => isset($atts['per_page']) ? intval($atts['per_page']) : 8,
        'post_type' => 'product',
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $exclude_ids,
                'operator' => 'NOT IN',
            ),
        ),
    );

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        woocommerce_product_loop_start();
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part('content', 'product');
        }
        woocommerce_product_loop_end();
    }
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('custom_best_selling_products', 'custom_best_selling_products');

//кастмная сортировка категорий
function get_sorted_product_categories() {
    // Определяем слаги категорий, которые должны отображаться последними
    $specific_slugs = array(
        'motor-grader',
        'forklift-truck',
        'railway-transport',
        'agricultural-machinery',
        'tractor',
        'tram',
        'trolleybus',
    );

    $specific_slugs_2 = array(
        'other-cardan-shafts',
        'according-to-your-sizes',
        'select-a-cardan-shaft',
    );

    // Получаем все категории товаров
    $terms = get_terms( array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
    ) );

    if ( is_wp_error( $terms ) || empty( $terms ) ) {
        return array();
    }

    $russian   = array();
    $english   = array();
    $specific  = array();

    foreach ( $terms as $term ) {
        if ( in_array( $term->slug, $specific_slugs ) ) {
            // Добавляем в список специфичных категорий
            $specific[] = $term;
        } elseif ( in_array( $term->slug, $specific_slugs_2 ) ) {
            $specific_2[] = $term;
        } elseif ( preg_match( '/[а-яА-ЯЁё]/u', $term->name ) ) {
            // Проверяем, содержит ли название категории кириллические символы
            $russian[] = $term;
        } else {
            // Все остальные категории считаем английскими
            $english[] = $term;
        }
    }

    // Устанавливаем локаль для правильной сортировки русских категорий
    $current_locale = setlocale( LC_COLLATE, 0 ); // Сохраняем текущую локаль
    setlocale( LC_COLLATE, 'ru_RU.UTF-8' );      // Устанавливаем русскую локаль

    // Сортируем русские категории по алфавиту
    usort( $russian, function( $a, $b ) {
        return strcoll( $a->name, $b->name );
    });

    // Возвращаем локаль к исходному значению
    setlocale( LC_COLLATE, $current_locale );

    // Сортируем английские категории по алфавиту
    usort( $english, function( $a, $b ) {
        return strcasecmp( $a->name, $b->name );
    });

    // Объединяем все категории в нужном порядке
    return array_merge( $russian, $english, $specific, $specific_2 );
}

function get_sorted_product_tags_and_subcategories() {
    // Получаем все метки
    $terms = get_terms( array(
        'taxonomy'   => 'product_tag', // Таксономия меток
        'hide_empty' => false,
    ) );

    if ( is_wp_error( $terms ) || empty( $terms ) ) {
        return array();
    }

    $russian = array();
    $english = array();

    foreach ( $terms as $term ) {
        if ( preg_match( '/[а-яА-ЯЁё]/u', $term->name ) ) {
            // Проверяем, содержит ли название метки кириллические символы
            $russian[] = $term;
        } else {
            // Все остальные метки считаем английскими
            $english[] = $term;
        }
    }

    // Устанавливаем локаль для правильной сортировки русских меток
    $current_locale = setlocale( LC_COLLATE, 0 ); // Сохраняем текущую локаль
    setlocale( LC_COLLATE, 'ru_RU.UTF-8' );      // Устанавливаем русскую локаль

    // Сортируем русские метки по алфавиту
    usort( $russian, function( $a, $b ) {
        return strcoll( $a->name, $b->name );
    });

    // Возвращаем локаль к исходному значению
    setlocale( LC_COLLATE, $current_locale );

    // Сортируем английские метки по алфавиту
    usort( $english, function( $a, $b ) {
        return strcasecmp( $a->name, $b->name );
    });

    // Получаем подкатегории для категории 'kardany'
    $kardany_subcategories = array();
    $kardany_term = get_term_by('slug', 'kardany', 'product_cat'); // Получаем термин категории 'kardany'

    if ( $kardany_term ) {
        $kardany_subcategories = get_terms( array(
            'taxonomy'   => 'product_cat',
            'parent'     => $kardany_term->term_id,
            'hide_empty' => false,
        ) );

        // Сортируем подкатегории 'kardany' по алфавиту
        usort( $kardany_subcategories, function( $a, $b ) {
            return strcasecmp( $a->name, $b->name );
        });
    }

    // Объединяем все метки и подкатегории в нужном порядке
    return array_merge( $russian, $english, $kardany_subcategories );
}


function filter_products_by_parent_category_on_product_tag_page($query) {
    if (!is_admin() && $query->is_main_query() && is_tax('product_tag')) {
        $parent_category_id = 0;

        // Получаем все родительские категории (только термины таксономии 'product_cat')
        $parent_categories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false, // Показывать все категории, даже если они пустые
            'parent'     => 0, // Получить только родительские категории
        ));
        
        // Ищем категорию с дочерними категориями
        foreach ($parent_categories as $category) {
            $subcategories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
                'parent'     => $category->term_id,
            ));
        
            if (!empty($subcategories)) {
                $parent_category_id = $category->term_id;
                break; // Останавливаем цикл, как только нашли подходящую категорию
            }
        }

        if ($parent_category_id === 0) {
            return; // Если не найдена родительская категория, прекращаем выполнение
        }

        // Получаем ID всех дочерних категорий, включая родительскую
        $child_categories = get_terms(array(
            'taxonomy'   => 'product_cat',
            'child_of'   => $parent_category_id,
            'hide_empty' => false,
            'fields'     => 'ids',
        ));
        
        $child_categories[] = $parent_category_id;

        // Получаем существующий tax_query или создаем новый массив
        $tax_query = $query->get('tax_query');

        if (!is_array($tax_query)) {
            $tax_query = array();
        }

        // Добавляем новый запрос в tax_query
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $child_categories,
            'operator' => 'IN',
        );

        // Устанавливаем обновленный tax_query для основного запроса
        $query->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'filter_products_by_parent_category_on_product_tag_page');

// function create_default_pages() {
//     // Проверьте, не были ли страницы уже созданы
//     $pick_up_page_title = 'Подобрать';
//     $repair_page_title = 'Ремонт';

//     $pick_up_page_check = get_page_by_title($pick_up_page_title);
//     $repair_page_check = get_page_by_title($repair_page_title);


//     // Если страницы с этими заголовками не существуют, создаем их
//     if (!$pick_up_page_check) {
//         wp_insert_post(array(
//             'post_title'    => $pick_up_page_title,
//             'post_content'  => 'Подобрать.',
//             'post_status'   => 'publish',
//             'post_type'     => 'page',
//             'meta_input'     => [ '_wp_page_template'=>'pick_up.php' ],
//         ));
//     }

//     if (!$repair_page_check) {
//         wp_insert_post(array(
//             'post_title'    => $repair_page_title,
//             'post_content'  => 'Ремонт.',
//             'post_status'   => 'publish',
//             'post_type'     => 'page',
//             'meta_input'     => [ '_wp_page_template'=>'repair.php' ],
//         ));
//     }
// }
// add_action('after_setup_theme', 'create_default_pages');

function create_default_pages() {
    // Проверьте, не были ли страницы уже созданы
    $pick_up_page_title = 'Подобрать';
    $repair_page_title = 'Ремонт';

    $pick_up_page_check = get_page_by_path('pick-up');
    $repair_page_check = get_page_by_path('repair');

    // Если страницы с этими заголовками не существуют, создаем их
    if (!$pick_up_page_check) {
        $pick_up_page_id = wp_insert_post(array(
            'post_title'    => $pick_up_page_title,
            'post_content'  => 'Подобрать.',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'post_name'     => 'pick-up',
        ));

        // Установить шаблон страницы, если страница была успешно создана
        if ($pick_up_page_id && !is_wp_error($pick_up_page_id)) {
            update_post_meta($pick_up_page_id, '_wp_page_template', 'pick_up.php');
        }
    }

    if (!$repair_page_check) {
        $repair_page_id = wp_insert_post(array(
            'post_title'    => $repair_page_title,
            'post_content'  => 'Ремонт.',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'post_name'     => 'repair',
        ));

        // Установить шаблон страницы, если страница была успешно создана
        if ($repair_page_id && !is_wp_error($repair_page_id)) {
            update_post_meta($repair_page_id, '_wp_page_template', 'repair.php');
        }
    }
}
add_action('init', 'create_default_pages');

function style_mobile() {
    if (is_front_page() || is_cart() || is_checkout() || is_account_page() || is_singular('product')) {
        ?> 
            <style>
                @media screen and (max-width: 990px) {
                    #primary {
                        margin-top: 136px;
                    }
                }
            </style>
        <?php
    }
}
add_action('wp_head', 'style_mobile');

//добавление кнопки очистить корзину 
function true_empty_cart() {
    if ( isset( $_GET['empty-cart'] ) && $_GET['empty-cart'] === 'true' ) {
        WC()->cart->empty_cart();
    }
}
add_action( 'init', 'true_empty_cart' );


function add_back_button_to_sub_menu($items, $args) {
    // Применяем фильтр только для меню с ID 'site-navigation'
    if ($args->menu_id == 'site-navigation') {
        var_dump($args->menu_id);
        foreach ($items as $item) {
            // Проверяем, есть ли у элемента класс 'menu-item-has-children'
            if (in_array('menu-item-has-children', $item->classes)) {
                // Создаем HTML-код кнопки 'Назад'
                $back_button = '<li class="menu-back-item"><a id="close-menu-back" class="block-catalog__mobile-button-back"><span class="icon-Left-2"></span><p class="txt-normal">Назад</p></a></li>';

                // Если у элемента есть подменю, добавляем кнопку 'Назад' в начало подменю
                if (strpos($item->title, '<ul class="sub-menu">') === false) {
                    $item->title .= '<ul class="sub-menu">' . $back_button . '</ul>';
                }
            }
        }
    }

    return $items;
}
add_filter('wp_nav_menu_objects', 'add_back_button_to_sub_menu', 10, 2);

// Обработчик Ajax для отправки заказа из корзины
// Добавляем обработчик для получения данных корзины
add_action('wp_ajax_get_cart_data', 'get_cart_data');
add_action('wp_ajax_nopriv_get_cart_data', 'get_cart_data');
function get_cart_data() {
    // Получаем данные корзины
    $cart_data = WC()->cart->get_cart();

    if (empty($cart_data)) {
        wp_send_json_error('Корзина пуста или данные недоступны');
    }

    wp_send_json_success($cart_data); // Отправляем данные корзины в формате JSON
    wp_die();
}

// Добавляем обработчик для отправки заказа
add_action('wp_ajax_submit_callback_order', 'submit_callback_order');
add_action('wp_ajax_nopriv_submit_callback_order', 'submit_callback_order');
function submit_callback_order() {
    // Проверка данных из формы
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $cart_data = isset($_POST['cart_data']) ? $_POST['cart_data'] : [];

    if (empty($name) || empty($phone) || empty($cart_data)) {
        wp_send_json_error('Не все данные заполнены');
    }

    // Создаем заказ
    $order = wc_create_order();

    // Добавляем товары из корзины в заказ
    foreach ($cart_data as $cart_item_key => $cart_item) {
        $product_id = $cart_item['product_id']; // ID продукта
        $quantity = $cart_item['quantity']; // Количество

        // Добавляем продукт в заказ
        $order->add_product( wc_get_product($product_id), $quantity );
    }

    // Добавляем данные пользователя в заказ
    $order->set_billing_first_name($name);
    $order->set_billing_phone($phone);

    // Устанавливаем статус заказа
    $order->set_status('pending'); // Или другой статус, например 'processing'

    // Сохраняем заказ
    $order->save();

    // Возвращаем ID заказа для дальнейшей обработки
    wp_send_json_success($order->get_id());
    wp_die(); // Завершаем Ajax запрос
}

// Обработка очистки корзины
function clear_cart() {
    WC()->cart->empty_cart(); // Очистить корзину
    // Возвращаем успешный JSON-ответ
    wp_send_json_success('Корзина успешно очищена');
    wp_die();
}
add_action('wp_ajax_clear_cart', 'clear_cart');
add_action('wp_ajax_nopriv_clear_cart', 'clear_cart');


// Добавляем скрипт заказ из корзины + данные из всплывашки чисто для стр корзины
function enqueue_callback_form_script() {
    if (is_cart()) { 
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('#callbackButton').hide();
                $('#callbackRequestForm').submit(function(e) {
                    e.preventDefault();

                    var name = $('#callback-name').val();
                    var phone = $('#callback-phone').val();

                    // Получаем данные корзины через Ajax
                    $.ajax({
                        url: custom_ajax_obj.ajax_url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'get_cart_data',
                        },
                        success: function(response) {
                            var cart_data = response.success ? response.data : {};  // Если ошибка, отправляем пустые данные корзины

                            // Отправляем данные формы и корзины на сервер для создания заказа
                            $.ajax({
                                url: custom_ajax_obj.ajax_url,
                                type: 'POST',
                                data: {
                                    action: 'submit_callback_order',
                                    name: name,
                                    phone: phone,
                                    cart_data: cart_data
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // Показать сообщение об успешном создании заказа
                                        $('#callbackRequestFormThanks').show();
                                        $('#closeCallbackForm').trigger('click');

                                        // Привязываем клик на кнопке "ОК" во всплывающем окне
                                        $('#OKCallbackFormThanks').click(function() {
                                            $('#callbackRequestFormThanks').hide();

                                            console.log('Заказ создан успешно. ID: ' + response.data);
                                            // Очистить корзину через Ajax
                                            $.ajax({
                                                url: custom_ajax_obj.ajax_url,
                                                type: 'POST',
                                                data: {
                                                    action: 'clear_cart'
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        console.log('Корзина успешно очищена');
                                                        location.reload(true);  // Обновляем страницу после очистки
                                                    } else {
                                                        console.error('Ошибка при очистке корзины:', response.data);
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Ошибка при очистке корзины:', xhr.responseText);
                                                }
                                            });
                                        });
                                    } else {
                                        console.error('Ошибка при создании заказа: ' + response.data);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Ошибка при отправке данных формы:', xhr.responseText);
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Ошибка при получении данных корзины:', xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'enqueue_callback_form_script');

// Обработка изменения количества
function cart_change_quantity() {
    if (is_cart()) {
        ?>
        <script>
            jQuery(document).ready(function($) {
                // Обработка кликов на кнопки плюс/минус
                $('body').on('click', 'button.plus, button.minus', function() {
                    var qty = $(this).parent().find('input.qty');
                    var val = parseInt(qty.val());
                    var min = parseInt(qty.attr('min'));
                    var max = parseInt(qty.attr('max'));
                    var step = parseInt(qty.attr('step'));
                    var remove_link = $(this).closest('.woocommerce-cart-form__cart-item').find('.remove'); // Ссылка для удаления товара

                    //сonsole.log(remove_link);
                    // Меняем количество в зависимости от кнопки
                    if ($(this).hasClass('plus')) {
                        if (max && val >= max) {
                            qty.val(max);
                        } else {
                            qty.val(val + step);
                        }
                    } else {
                        if (min && val <= min) {
                            qty.val(min);
                        } else if (val > 1) {
                            qty.val(val - step);
                        } else if (val === 1) {
                            // Если количество становится 1 и нажимают минус - удаляем товар
                            remove_link.trigger('click'); // Триггерим стандартный запрос удаления WooCommerce
                            return;
                        }
                    }

                    // Триггерим событие "change" для обновления
                    qty.trigger('change');
                });

                // Обновление корзины при изменении количества
                $('body').on('click', '.plus, .minus', function() { 
                    $( '[name="update_cart"]' ).trigger( 'click' );
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'cart_change_quantity');
