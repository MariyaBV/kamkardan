<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_categories = wc_get_product_category_list( $product->get_id(), ', ' );
$product_categories_plain = strip_tags($product_categories);

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<<<<<<< HEAD

	<div class="product-item">
		<div class="block-quantity-button">
			<button class="quantity-arrow-minus"> - </button>
			<div class="quantity">
				<input type="number" class="qty" name="quantity" value="1" min="1" />
			</div>
			<button class="quantity-arrow-plus"> + </button>
			<a class="add-to-cart button add_to_cart_button ajax_add_to_cart" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"><span class="add-to-cart-text">Купить</span></a>
		</div>
	</div>
=======
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
	<div class="block-description-card txt-normal">
		<div class="block-description-card__item">
			<span class="icon-bi_check-all"></span>
			<p>Сертификат соответствия ЕАС</p>
		</div>
		<div class="block-description-card__item">
			<span class="icon-bi_check-all"></span>
			<p>Гарантия <?php if ((strpos($product_categories_plain, 'Крестовины') === false) && (strpos($product_categories_plain, 'Комплектующие') === false)): ?> на новые карданы <?php endif; ?> - 1 год</p>
		</div>
	</div>
<<<<<<< HEAD
=======
	<div class="product-item">
		<div class="block-quantity-button">
			<button class="quantity-arrow-minus"> - </button>
			<div class="quantity">
				<input type="number" class="qty" name="quantity" value="1" min="1" />
			</div>
			<button class="quantity-arrow-plus"> + </button>
			<a class="add-to-cart button add_to_cart_button ajax_add_to_cart" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"><span class="add-to-cart-text">Купить</span></a>
		</div>
	</div>
	<hr class="hr-line">
	<p class="subtitle image-single-product-block__text">Некоторые изображения носят исключительно уведомительный характер. Для уточнения параметров <?php if ((strpos($product_categories_plain, 'Крестовины') === false) && (strpos($product_categories_plain, 'Комплектующие') === false)):?> вала <?php endif; ?> обращайтесь к менеджерам</p>
    
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
	<?php /*do_action( 'woocommerce_after_add_to_cart_form' );*/ ?>

<?php endif; ?>


