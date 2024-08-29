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
        <div>
            <?php if ( !is_shop() ): ?>
            <div class="orderby__title">
                <?php 
                if ($product) {
                    if ((strpos($product_categories_plain, 'Крестовины') === false) && (strpos($product_categories_plain, 'Комплектующие') === false)) {
                        echo wc_get_product_category_list( $product->get_id(), ', ', '<h2 class="posted_in">' . _n( 'Карданы для ', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</h2>' ); 
                    } else {
                        echo wc_get_product_category_list( $product->get_id(), ', ', '<h2 class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</h2>' ); 
                    }
                } ?>
            </div>
            <?php endif; ?>
            <?php if (strpos($product_categories_plain, 'Комплектующие') === false) :?>
            <div class="block-sort">
                <form class="woocommerce-ordering orderby-block" method="get">
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
                </form>

                <?php if (strpos($product_categories_plain, 'Крестовины') === false){ echo print_length_filter();} ?>
            </div>
            <?php endif; ?>
    </div> 
    <?php if ( !is_shop() ){ echo get_image_from_category(); } ?>
</div>
