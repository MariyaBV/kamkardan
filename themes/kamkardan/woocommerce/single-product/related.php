<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$is_crosspieces_category = has_term( 'crosspieces', 'product_cat', $product->get_id() );
$is_accessories_category = has_term( 'accessories', 'product_cat', $product->get_id() );

$countProduct = 3;
$class4Prodicts ='';

if ( $is_crosspieces_category || $is_accessories_category ) {
	$countProduct = 4;
	$class4Prodicts = 'fourProducts';
}

if ( $related_products ) : ?>

	<section class="related products <?php echo $class4Prodicts?>">
		<h3 class="margin-bottom-16">Может быть интересным</h3>

		<?php
			woocommerce_product_loop_start();

			// Общее количество связанных товаров
			$total_related = count( $related_products );

			// Если товаров меньше или равно требуемому количеству, выводим все
			if ( $total_related <= $countProduct ) {
				$selected_products = $related_products;
			} else {
				// Если товаров больше, выбираем случайные
				$random_keys = array_rand( $related_products, $countProduct );
				$selected_products = array_intersect_key( $related_products, array_flip( (array) $random_keys ) );
			}

			foreach ( $selected_products as $related_product ) {
				$post_object = get_post( $related_product->get_id() );
				setup_postdata( $GLOBALS['post'] = $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part( 'content', 'product' );
			}

			woocommerce_product_loop_end();
		?>

	</section>
	<?php
endif;

wp_reset_postdata();
