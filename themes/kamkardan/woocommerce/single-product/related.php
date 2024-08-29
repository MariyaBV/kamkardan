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

if ( $related_products ) : ?>

	<section class="related products">
		<h3 class="margin-bottom-16">Может быть интересным</h3>

		<?php
			woocommerce_product_loop_start();

			// Выбираем 3 случайных товара из $related_products
			$random_keys = array_rand($related_products, 3);

			foreach ($random_keys as $key) {
				$related_product = $related_products[$key];
				
				$post_object = get_post($related_product->get_id());
				setup_postdata($GLOBALS['post'] = $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

				wc_get_template_part('content', 'product');
			}

			woocommerce_product_loop_end();
		?>

	</section>
	<?php
endif;

wp_reset_postdata();
