<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals custom-cart-totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="shipping">
				<span><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
				<span data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></span>
		</div>

		<?php endif; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<span><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
				</div>
					<?php
				}
			} else {
				?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></th>
					<td data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="order-total">
			<p><?php esc_html_e( 'Total', 'woocommerce' ); ?>:</p>
			<span data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<div class="wc-proceed-to-checkout custom-button-checkout">
		<a class="checkout-button button alt wc-forward" id="callbackButtonCart">Оформить заказ</a>
		<?php /*do_action( 'woocommerce_proceed_to_checkout' ); */?>
	</div>
	
	<a href="<?= get_privacy_policy_url()?>" class="custom-privacy-policy subtitle">
		Нажимая кнопку «Оформить заказ», вы соглашаетесь с обработкой своих персональных данных в соответстии с нашей Политикой конфеденциальности.
	</a>
	
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>

<div class="block-about-delivery">
	<h3>Доставка по России </h3>
	<ul>
		<li>
			<span class="icon-carbon_delivery-3"></span>
			Доставка по России с помощью транспортных компаний - ПЭК, Байкал, ДЛ, Энергия, Мэйджик Транс, КИТ. Возможна доставка через другие транспортные компании, по договоренности с заказчиком.
		</li>
		<li>
			<span class="icon-iconoir_box-iso-3"></span>
			Отгрузка товара в транспортную компанию в течение 1-2 рабочих дней с момента оплаты, при условии наличия товара на складе. Для спецзаказов отгрузка в транспортную компанию в строго оговоренное время с заказчиком.
		</li>
		<li>
			<span class="icon-deliver-hand-2"></span>
			Доставка транспортной компанией оплачивается за счет заказчика. При наличии спецусловий, доставка может быть осуществлена за счет компании.
		</li>
	</ul>
</div>
