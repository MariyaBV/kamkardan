<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
$product = wc_get_product(get_the_ID());
$product_categories = wc_get_product_category_list( $product->get_id(), ', ' );
$product_categories_plain = strip_tags($product_categories);
?>

    <div class="orderby__block-title-sort">
        <div class="orderby__block-title">
            <?php if ( !is_shop() ): ?>
            <div class="orderby__title">
            <div class="product-category__img-mobile"><?php if ( !is_shop() ){ echo get_image_from_category(); } ?></div>
                <?php 
                /*if ($product) {
                    if ((strpos($product_categories_plain, 'Крестовины') === false) && (strpos($product_categories_plain, 'Комплектующие') === false)) {
                        echo wc_get_product_category_list( $product->get_id(), ', ', '<h2 class="posted_in">' . _n( 'Карданы для ', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</h2>' ); 
                    } else {
                        echo wc_get_product_category_list( $product->get_id(), ', ', '<h2 class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</h2>' ); 
                    }
                } */?>

                <?php
                if ($product) {
                    // Получаем URL страницы
                    $current_url = home_url(add_query_arg(array(), $_SERVER['REQUEST_URI']));
                    
                    // Разбиваем URL на части
                    $url_parts = explode('/', trim(parse_url($current_url, PHP_URL_PATH), '/'));
                    
                    // Получаем последнее слово из URL (если оно есть)
                    $last_url_segment = end($url_parts);

                    // Определяем, является ли последний сегмент меткой или категорией
                    $is_tag_page = strpos($current_url, 'product-tag/') !== false;
                    $is_category_page = strpos($current_url, 'product-category/') !== false;
                    
                    // Инициализируем переменные для заголовка
                    $header_title = '';
                    
                    
                    if ($is_tag_page) {
                        // Попробуем получить метку по последнему сегменту
                        $tag = get_term_by('slug', $last_url_segment, 'product_tag');
                        if ($tag && !is_wp_error($tag)) {
                            $header_title = 'Карданы для ' . esc_html($tag->name);
                        }
                    } elseif ($is_category_page) {
                        // Попробуем получить категорию по последнему сегменту
                        $category = get_term_by('slug', $last_url_segment, 'product_cat');
                        if ($category && !is_wp_error($category)) {
                            // Проверяем, является ли категория дочерней категорию "Карданы"
                            $parent_is_kardans = false;
                            $ancestors = get_ancestors($category->term_id, 'product_cat');
                            foreach ($ancestors as $ancestor_id) {
                                $ancestor = get_term($ancestor_id, 'product_cat');
                                if ($ancestor && !is_wp_error($ancestor) && $ancestor->slug === 'kardany') {
                                    $parent_is_kardans = true;
                                    break;
                                }
                            }
                            if ($category->slug === 'kardany' || $parent_is_kardans) {
                                $header_title = 'Карданы для ' . esc_html($category->name);
                            } else {
                                $header_title = esc_html($category->name);
                            }
                        }
                    }

                    echo '<h2 class="posted_in">' . $header_title . '</h2>';
                }
                ?>



                 
                    <div class="block-sort-mobile">
                    <?php if (strpos($product_categories_plain, 'Комплектующие') === false) :?>  
                        <a id="block-sort-mobile-button">
                            <span class="icon-rivet-icons_filter-1"></span>
                        </a>
                        <span class="fillters-count">0</span>
                        <?php endif; ?>
                    </div>
                
            </div>
            <?php endif; ?>
            <?php if (strpos($product_categories_plain, 'Комплектующие') === false) :?>

            <div id="block-sort" class="block-sort">
                <?php /*<form class="woocommerce-ordering orderby-block" method="get">
                    <?php
                    // Проверяем наличие параметра 'orderby' в URL
                    $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';

                    // Устанавливаем значение по умолчанию, если 'orderby' отсутствует
                    if (empty($orderby)) {
                        $orderby = '';
                    }
                    ?>

                    <select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
                        <option value="" <?php selected( $orderby, '' ); ?>>⇵ Сортировать</option>    
                        <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                            <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="paged" value="1" />
                    <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
                </form>*/?>

                <form class="woocommerce-ordering custom-ordering" method="get">
                    <input type="hidden" name="paged" value="1">
                    <?php wc_query_string_form_fields(null, array('submit', 'product-page')); ?>

                    <div class="custom-ordering__select" data-attribute="orderby">
                        <div class="custom-ordering-select">
                            <div class="custom-ordering-trigger" data-attribute-label="<?php esc_attr_e('Сортировать', 'woocommerce'); ?>">
                                <?php echo $catalog_orderby_options[$orderby] ?? '<span class="icon-Frame-10"></span>Сортировать'; ?>
                            </div>
                            <ul class="custom-ordering-options">
                                <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                                    <li class="custom-ordering-option <?php echo $orderby === $id ? 'selected' : ''; ?>" data-value="<?php echo esc_attr($id); ?>">
                                        <input type="radio" name="orderby" value="<?php echo esc_attr($id); ?>" <?php checked($orderby, $id); ?>>
                                        <?php echo wp_kses_post($name); ?>
                                        <span class="icon-Onyes"><span class="path1"></span><span class="path2"></span></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </form>

                <form class="woocommerce-ordering custom-ordering mobile" method="get">
                    <p class="subtitle-mobile margin-bottom-24">Фильтры</p>
                    <a href="" id="close-ordering-menu"><span class="icon-Close-1 close-catalog-menu"></span></a>
                    <input type="hidden" name="paged" value="1">
                    <?php wc_query_string_form_fields(null, array('submit', 'product-page')); ?>

                    <div class="custom-ordering__select" data-attribute="orderby">
                        <div class="custom-ordering-select">
                            <ul class="custom-ordering-options">
                                <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                                    <li class="custom-ordering-option <?php echo $orderby === $id ? 'selected' : ''; ?>" data-value="<?php echo esc_attr($id); ?>">
                                        <input type="radio" name="orderby" value="<?php echo esc_attr($id); ?>" <?php checked($orderby, $id); ?>>
                                        <?php echo wp_kses_post($name); ?>
                                        <span class="icon-Onyes"><span class="path1"></span><span class="path2"></span></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </form>

                <?php if (strpos($product_categories_plain, 'Крестовины') === false){ 
                    echo print_length_filter();
                } else {
                    echo print_filters();
                }?>
            </div>
            <?php endif; ?>
    </div> 
    <div class="product-category__img-desktop">
        <div class="product-category__img">
            <?php if ( !is_shop() ){ echo get_image_from_category(); } ?>
        </div>
    </div>
</div>
