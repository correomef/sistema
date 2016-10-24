<?php

/*
Template Name: carrito
*/


/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>
<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove">&nbsp;</th>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name">Codigo</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php

		/*para mail carrito*/
		if ($_REQUEST['accion'] === 'mailTo'){
			  global $current_user;


					$address = array(
						'first_name' => 'COTIZACION via Email',
						'email'      => $_REQUEST['email']
				    );

			    $default_password = wp_generate_password();

			    if (!$user = get_user_by('login', $email)) $user = wp_create_user( $email, $default_password, $email );

			    $order = wc_create_order(array('customer_id' => $user->id));

		}

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );




			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {


				if ($_REQUEST['accion'] === 'mailTo'){
				/*para mail carrito*/
					$order->add_product( $_product, $cart_item['quantity'] );
				}


				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-remove">
						<?php
							//echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							$idProductoEnCarro = ( $_product->variation_id) ? $_product->variation_id : $product_id;
						?>
						<button type="submit" data-key = "<?PHP echo $cart_item_key;?>" data-product_id="<?php echo $idProductoEnCarro ?>" data-product_sku="<?php echo $_product->get_sku() ?>" data-quantity="0" data-borrar="borrar" class="add_to_cart_button button product_type_simple remove ajax_add_to_cart">×</button>
					</td>

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
							}
						?>
					</td>

					<td>
						<?php echo $_product->get_sku() ?>
					</td>

					<td class="product-name">
						<?php
							if ( ! $_product->is_visible() ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</td>

					<td class="product-price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity()-1,
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				<?php } ?>

				<input type="submit" class="add_to_cart_button" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />


				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>



	<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

		<?php do_action( 'woocommerce_before_cart_totals' ); ?>

		<h2><?php _e( 'Cart Totals', 'woocommerce' ); ?></h2>

		<table cellspacing="0">

			<tr class="cart-subtotal">
				<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>
<!--
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

			<?php elseif ( WC()->cart->needs_shipping() ) : ?>

				<tr class="shipping">
					<th><?php _e( 'Shipping', 'woocommerce' ); ?></th>
					<td><?php woocommerce_shipping_calculator(); ?></td>
				</tr>

			<?php endif; ?> -->

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
				<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php wc_cart_totals_taxes_total_html(); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

			<tr class="order-total">
				<th><?php _e( 'Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

		</table>

		<?php if ( WC()->cart->get_cart_tax() ) : ?>
			<p><small><?php

				$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
					: '';

				printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

			?></small></p>
		<?php endif; ?>

		<div class="wc-proceed-to-checkout">


	<!-- 	<a class="add_to_cart_button abreModal" data-modal="#cotizacionMail" href="">Enviar Cotización a mi correo</a>

		<a class="add_to_cart_button imprimir" href="">Imprimir Cotizacion</a> -->

			<a class="add_to_cart_button" href="<?php echo get_bloginfo("url").'/mi-compra' ?>">Comprar</a>

			<?php

			global $cabeceraMail, $mensajeEmail;

			/*para mail carrito*/
			if ($_REQUEST['accion'] === 'mailTo'){

				$order->set_address( $address, 'billing' );
				$order->set_address( $address, 'shipping' );
				$order->calculate_totals();

				$cabeceraMail = 'Pedido de Cotización';
				$mensajeEmail = 'Esta es la cotización que solicitaste.';

				$mailer = WC()->mailer();
				$mails = $mailer->get_emails();
				if ( ! empty( $mails ) ) {
				    foreach ( $mails as $mail ) {
				         if ( $mail->id == 'customer_processing_order' ) {
				         	echo '$order->id '.$order->id;
					       $mail->trigger( $order->id );
					       //echo "<h2>Tu cotizacion ha sido enviada a " . $_REQUEST['email']. "</h2>";
				        }
				     }
				}
			}

			 ?>


			<?php if ($_REQUEST['accion'] === 'imprimir'): ?>
				<script type="text/javascript">
				window.print();
				</script>
			<?php endif ?>

		</div>

		<?php do_action( 'woocommerce_after_cart_totals' ); ?>

	</div>



<?php do_action( 'woocommerce_after_cart' ); ?>
