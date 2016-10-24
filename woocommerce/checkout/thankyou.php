<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( $order ) : ?>

<?php
if ( sizeof( $order->get_items() ) > 0  ) {


		foreach( $order->get_items() as $item_id => $item ) {
			$ID = $item['product_id'];
			$talle = $item['talle'];
			$CantidadExistente = get_post_meta( $ID, 'stock-'.$talle );
			update_post_meta( $ID, 'stock-'.$talle, ($CantidadExistente[0] - ($item['qty'] ) ) );
		}

		header("Location: ".get_bloginfo('url')."/gracias"); /* Redirect browser */
		exit();

}
?>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
