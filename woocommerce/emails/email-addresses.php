<?php
/**
 * Admin new order email
 *
 * @author WooThemes
 * @package WooCommerce/Templates/Emails/HTML
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$orderDATOS = wc_get_order( $order->id ); ?>

<table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">

<tr>

	<td valign="top" width="50%">

		<h3><?php _e( 'Billing address', 'woocommerce' ); ?></h3>

		<!-- <p><?php echo $order->get_formatted_billing_address(); ?></p> -->


			<?php

			$AAbilling_fields = array(

				'first_name' => array(
					'label' => __( 'First Name', 'woocommerce' ),
					'show'  => true
					),
				'DNICUIT' => array(
					'label' => __( 'DNI / CUIT', 'woocommerce' ),
					'show'  => true
					),

				'email' => array(
					'label' => __( 'Email', 'woocommerce' ),
					),
				'telefonoCelular' => array(
					'label' => __( 'Telefono', 'woocommerce' ),
					),
				) ;

			foreach ( $AAbilling_fields as $key => $field ) {
				if ( isset( $field['show'] ) && false === $field['show'] ) {
					continue;
				}

				$field_name = 'billing_' . $key;

				if ( $orderDATOS->$field_name ) {
					echo '<p><b>' . esc_html( $field['label'] ) . ':</b><br> ' . make_clickable( esc_html( $orderDATOS->$field_name ) ) . '</p>';
				}
			}?>

	</td>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>

		<td valign="top" width="50%">

			<h3><?php _e( 'Shipping address', 'woocommerce' ); ?></h3>

			<!-- <p><?php echo $shipping; ?></p> -->


				<?php

				$datosDeEnvio = array(

					'address_1' => array(
						'label'       => __( 'Dirección', 'woocommerce' ),
						'show'  => true
						),
					'address_numero' => array(
						'label'       => __( 'N°', 'woocommerce' ),
						'show'  => true
						),
					'address_depto' => array(
						'label'       => __( 'Dpto', 'woocommerce' ),
						'show'  => true
						),


					'city' => array(
						'label' => __( 'City', 'woocommerce' ),
						'show'  => true
						),

					'state' => array(
						'label' => __( 'State/County', 'woocommerce' ),
						'class'   => 'js_field-state select short',
						'show'  => true
						),
					'postcode' => array(
						'label' => __( 'Postcode', 'woocommerce' ),
						'show'  => true
						)
					);

				foreach ( $datosDeEnvio as $key => $field ) {
					if ( isset( $field['show'] ) && false === $field['show'] ) {
						continue;
					}

					$field_name = 'shipping_' . $key;

					if ( ! empty( $orderDATOS->$field_name ) ) {
						echo '<p><b>' . esc_html( $field['label'] ) . ':</b><br> ' . make_clickable( esc_html( $orderDATOS->$field_name ) ) . '</p>';
					}
				} ?>

				<?php if (get_post_meta( $order->id, 'Quien Recibe o Retira', true ) !== ''): ?>
					<b>Quien Recibe o Retira</b><br>
					<?php echo get_post_meta( $order->id, 'Quien Recibe o Retira', true ); ?>
					<br>
					<br>
				<?php endif; ?>

				<?php if (get_post_meta( $order->id, 'Horario de Entrega', true ) !== ''): ?>

					<b>Horario de Entrega</b><br>
					<?php echo get_post_meta( $order->id, 'Horario de Entrega', true );?>
					<br>
					<br>

				<?php endif;?>
				<?php if (get_post_meta( $order->id, 'Comentario Adicional', true ) !== ''): ?>

					<b>Comentario Adicional</b><br>
					<?php echo get_post_meta( $order->id, 'Comentario Adicional', true ); ?>
					<br>
					<br>

				<?php endif; ?>




		</td>

	<?php endif; ?>

</tr>

</table>