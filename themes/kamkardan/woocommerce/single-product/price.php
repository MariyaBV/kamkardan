<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$price_html = $product->get_price_html();

if ( !empty($price_html) ) {
    // Используем регулярное выражение с модификатором s
    $pattern = '/(<del[^>]*>.*?<\/del>)(.*?)(<ins[^>]*>.*?<\/ins>)/s';
    $replacement = '$3$2$1'; // Меняем местами del и ins, сохраняя промежуточный контент
    $price_html = preg_replace($pattern, $replacement, $price_html);
} else {
    $price_html = 'Цену уточняйте';
}

if ( $price_html ): 
?>
    <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $price_html; ?><?php echo genius_display_discount_badge_return(); ?></p>
<?php endif; ?>
<?php
// Получение данных о запасах
$stock_status = get_post_meta( $product->get_id(), '_stock_status', true );
$stock_status_options = wc_get_product_stock_status_options();
$stock_quantity = $product->get_stock_quantity();
$low_stock_threshold = get_option('woocommerce_notify_low_stock_amount');
?>
<div class="stock-status">
    <?php 
    if ( $stock_status === 'outofstock' ) {
        echo '<p class="out-of-stock"><span class="icon-close-filled-2"></span>Нет на складе</p>';
    } elseif ( $stock_status === 'onbackorder' ) {
        echo '<p class="available-on-backorder"><span class="icon-warning-2"><span class="path1"></span><span class="path2"></span></span>Доступно для предзаказа</p>';
    } elseif ( $stock_quantity <= $low_stock_threshold && $stock_quantity > 0 ) {
        echo '<p class="low-stock"><span class="icon-no-entry-2"></span>Осталось мало</p>';
    } else {
        echo '<p class="in-stock"><span class="icon-check-circle-5"></span>Есть на складе</p>';
    }
    ?>
</div>

<?php

