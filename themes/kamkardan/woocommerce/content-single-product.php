<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$is_crosspieces_category = has_term( 'crosspieces', 'product_cat', $product->get_id() );
$is_accessories_category = has_term( 'accessories', 'product_cat', $product->get_id() );

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="container">
		<?php if((!$is_crosspieces_category) && (!$is_accessories_category)):?>
			<div class="row">
				<div class="col-md-3 col-sm-0">
					<?php
					if ( function_exists( 'add_kardany_tags_and_subcategories_sidebar' ) ) {
						add_kardany_tags_and_subcategories_sidebar();
					}
					?>
				</div>
				<?php endif; ?>
				<div class="col-md-9 col-sm-12">
					<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>

					<div class="summary entry-summary">
						<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */

						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 1 );

						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

						remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
						add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

						do_action( 'woocommerce_single_product_summary' );
						?>
					</div>

					<?php
					/**
					 * Hook: woocommerce_after_single_product_summary.
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_upsell_display - 15
					 * @hooked woocommerce_output_related_products - 20
					 */
					do_action( 'woocommerce_after_single_product_summary' );
					?>

				</div>
			</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

<div class="block-search full-width-block">
	<?php echo do_shortcode('[search_block_custom]'); ?>
</div>


<?php
	$seo_description = get_field('seo');
	if ( $seo_description ) {
		echo '<div class="seo-text txt-s wrap">';
		echo $seo_description;
		echo '</div>';
	}
?>
