<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
global $product;

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

$product_id = $product->get_id();
$certificates = get_field('blok_s_sertifikatami', $product_id); 
$delivery = get_field('delivery', $product_id); 
$osnovnye_harakteristiki = get_field('osnovnye_harakteristiki', $product_id);

?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<?php /*<ul class="tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>*/?>
		<?php /*foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; */?>


		<div class="custom-description woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
			<div class="description-content">
			<?php if (!empty($product_tabs) && isset($product_tabs['description'])) {
				$description_tab = $product_tabs['description'];
				if (isset($description_tab['callback'])) {
					?>
					<div class="delivery-info">
						<h3 class="delivery-title">Описание</h3><?php
						call_user_func($description_tab['callback'], 'description', $description_tab);
					?></div><?php
				}
			} ?>

				<?php if ( $osnovnye_harakteristiki ): ?>
						<div class="delivery-info">
							<h3 class="delivery-title">Основные характеристики</h3>
							<p class="delivery"><?= $osnovnye_harakteristiki; ?></p>
						</div>
					<?php endif; ?>

				<?php if ( $delivery ): ?>
					<div class="delivery-info">
						<h3 class="delivery-title">Доставка</h3>
						<p class="delivery"><?= $delivery; ?></p>
					</div>
				<?php endif; ?>

				<?php if ( $certificates ): ?>
					<div class="certificates-info">
						<h3 class="certificates-title">Лицензии и сертификаты</h3>
						<div class="certificates">
							<?php foreach ( $certificates as $certificate ): ?>
								<?php $file_url = $certificate['sertifikat']; ?>
								<div class="certificate-item">
									<span class="icon-ion_document-outline"></span>
									<p><?= $certificate['nazvanie_dokumenta'] ?></p>
									<a href="<?php echo esc_url($file_url); ?>" target="_blank"></a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>


		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>


